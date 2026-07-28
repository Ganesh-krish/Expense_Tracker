<?php
if (!defined('ROOT_PATH')) {
    require_once __DIR__ . '/../config/database.php';
}
if (!defined('TABLE_USERS')) {
    require_once __DIR__ . '/../config/constants.php';
}

// Helper Functions

function redirect($url) {
    header('Location: ' . $url);
    exit();
}

function view($viewPath, $data = []) {
    extract($data);
    require_once VIEWS_PATH . $viewPath . '.php';
}

function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

function logMessage($level, $message, $context = []) {
    ensureLogDir();
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? ' | ' . json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '';
    $line = sprintf("[%s] [%s] %s%s%s", $timestamp, strtoupper($level), $message, $contextStr, PHP_EOL);
    file_put_contents(ROOT_PATH . 'logs/app.log', $line, FILE_APPEND | LOCK_EX);
}

function logInfo($message, $context = []) {
    logMessage('info', $message, $context);
}

function logSuccess($message, $context = []) {
    logMessage('success', $message, $context);
}

function logError($message, $context = []) {
    logMessage('error', $message, $context);
}

function logDebug($message, $context = []) {
    if (defined('APP_DEBUG') && APP_DEBUG) {
        logMessage('debug', $message, $context);
    }
}

function ensureLogDir() {
    $dir = ROOT_PATH . 'logs';
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(CSRF_TOKEN_LENGTH));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf() {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        http_response_code(403);
        die('Invalid CSRF token');
    }
}

function sanitize($input, $filter = FILTER_SANITIZE_SPECIAL_CHARS) {
    if (is_array($input)) {
        return array_map(function($item) use ($filter) {
            return sanitize($item, $filter);
        }, $input);
    }
    return filter_var($input, $filter);
}

function formatCurrency($amount, $currency = DEFAULT_CURRENCY) {
    $symbols = [
        'USD' => '$', 'EUR' => '€', 'GBP' => '£', 'INR' => '₹',
        'JPY' => '¥', 'CAD' => 'C$', 'AUD' => 'A$'
    ];
    $symbol = $symbols[$currency] ?? $currency;
    return $symbol . number_format($amount, 2);
}

function formatDate($date, $format = DEFAULT_DATE_FORMAT) {
    return date($format, strtotime($date));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function currentUser() {
    return $_SESSION['user_id'] ?? null;
}

function flashMessage($key, $message) {
    $_SESSION[$key] = $message;
}

function getFlashMessage($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}

function generateJwt($userId, $email, $role) {
    require_once ASSETS_PATH . 'vendor/jwt/autoload.php';
    $key = JWT_SECRET;
    $payload = [
        'sub' => $userId,
        'email' => $email,
        'role' => $role,
        'iat' => time(),
        'exp' => time() + JWT_EXPIRATION
    ];
    return \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
}

function validateJwt($token) {
    require_once ASSETS_PATH . 'vendor/jwt/autoload.php';
    try {
        $key = JWT_SECRET;
        $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));
        return (array)$decoded;
    } catch (\Exception $e) {
        return null;
    }
}

function logMail($to, $subject, $result, $error = '') {
    ensureLogDir();
    $line = sprintf("[%s] driver=socket | to=%s | subject=%s | result=%s | error=%s%s",
        date('Y-m-d H:i:s'),
        $to,
        $subject,
        $result ? 'sent' : 'failed',
        $error,
        PHP_EOL
    );
    file_put_contents(ROOT_PATH . 'logs/mail.log', $line, FILE_APPEND | LOCK_EX);
}

function smtpSend($to, $subject, $body) {
    $host = defined('MAIL_HOST') ? MAIL_HOST : 'smtp.gmail.com';
    $port = defined('MAIL_PORT') ? MAIL_PORT : 587;
    $encryption = defined('MAIL_ENCRYPTION') ? strtolower(MAIL_ENCRYPTION) : 'tls';
    $username = defined('MAIL_USERNAME') ? MAIL_USERNAME : '';
    $password = defined('MAIL_PASSWORD') ? MAIL_PASSWORD : '';
    $from = defined('MAIL_FROM_ADDRESS') ? MAIL_FROM_ADDRESS : $username;
    $fromName = defined('MAIL_FROM_NAME') ? MAIL_FROM_NAME : APP_NAME;

    logInfo('smtpSend started', [
        'to' => $to,
        'subject' => $subject,
        'host' => $host,
        'port' => $port,
        'encryption' => $encryption,
        'from' => $from,
        'fromName' => $fromName,
        'username' => $username
    ]);

    $protocol = $encryption === 'ssl' ? 'ssl://' : '';
    $socket = @stream_socket_client(
        $protocol . $host . ':' . $port,
        $errno,
        $errstr,
        30
    );

    if (!$socket) {
        $msg = 'Connection failed: ' . $errstr . ' (' . $errno . ')';
        logError('smtpSend failed', ['stage' => 'connect', 'error' => $msg, 'errno' => $errno, 'errstr' => $errstr]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    logInfo('smtpSend socket connected', ['host' => $host, 'port' => $port, 'protocol' => $protocol ?: 'plain']);

    $readResponse = function () use ($socket) {
        $response = fgets($socket, 512);
        logDebug('SMTP read', ['response' => trim($response)]);
        return $response;
    };

    $readMultiLine = function () use ($socket, $readResponse) {
        $response = '';
        do {
            $line = $readResponse();
            $response .= $line;
        } while (isset($line[3]) && $line[3] === '-');
        return $response;
    };

    $writeCommand = function ($command) use ($socket) {
        logDebug('SMTP write', ['command' => trim($command)]);
        fwrite($socket, $command . "\r\n");
    };

    $response = $readResponse();
    if (strpos($response, '220') !== 0) {
        fclose($socket);
        $msg = 'Invalid server response: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'greeting', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $writeCommand('EHLO ' . php_uname('n'));
    $ehloResponse = $readMultiLine();

    if ($encryption === 'tls') {
        if (stripos($ehloResponse, 'STARTTLS') !== false) {
            logInfo('smtpSend STARTTLS available', ['response' => trim($ehloResponse)]);
            $writeCommand('STARTTLS');
            $response = $readResponse();
            if (strpos($response, '220') !== 0) {
                fclose($socket);
                $msg = 'STARTTLS rejected: ' . trim($response);
                logError('smtpSend failed', ['stage' => 'starttls', 'error' => $msg]);
                logMail($to, $subject, false, $msg);
                return $msg;
            }

            $cryptoResult = stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            if ($cryptoResult !== true) {
                $msg = 'Failed to enable TLS crypto';
                logError('smtpSend failed', ['stage' => 'starttls_crypto', 'error' => $msg, 'php_errno' => $cryptoResult]);
                fclose($socket);
                logMail($to, $subject, false, $msg);
                return $msg;
            }
            logInfo('smtpSend TLS enabled');
        } else {
            logInfo('smtpSend STARTTLS not advertised, continuing without encryption');
        }
    }

    $writeCommand('AUTH LOGIN');
    $response = $readResponse();
    if (strpos($response, '334') !== 0) {
        fclose($socket);
        $msg = 'AUTH LOGIN rejected: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'auth_login', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $writeCommand(base64_encode($username));
    $response = $readResponse();
    if (strpos($response, '334') !== 0) {
        fclose($socket);
        $msg = 'Username rejected: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'auth_username', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $writeCommand(base64_encode($password));
    $response = $readResponse();
    if (strpos($response, '235') !== 0) {
        fclose($socket);
        $msg = 'Password rejected: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'auth_password', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    logInfo('smtpSend authenticated', ['username' => $username]);

    $writeCommand('MAIL FROM:<' . $from . '>');
    $response = $readResponse();
    if (strpos($response, '250') !== 0) {
        fclose($socket);
        $msg = 'MAIL FROM failed: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'mail_from', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $writeCommand('RCPT TO:<' . $to . '>');
    $response = $readResponse();
    if (strpos($response, '250') !== 0) {
        fclose($socket);
        $msg = 'RCPT TO failed: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'rcpt_to', 'error' => $msg, 'recipient' => $to]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $writeCommand('DATA');
    $response = $readResponse();
    if (strpos($response, '354') !== 0) {
        fclose($socket);
        $msg = 'DATA rejected: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'data', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $headers = "From: " . $fromName . " <" . $from . ">\r\n";
    $headers .= "To: " . $to . "\r\n";
    $headers .= "Subject: " . $subject . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";
    $headers .= "X-Mailer: PHP Socket SMTP\r\n";

    $message = $headers . "\r\n" . $body;
    $message = preg_replace('/\r\n\./', "\r\n..", $message);

    $writeCommand($message . "\r\n.");
    $response = $readResponse();
    if (strpos($response, '250') !== 0) {
        fclose($socket);
        $msg = 'Message rejected: ' . trim($response);
        logError('smtpSend failed', ['stage' => 'message', 'error' => $msg]);
        logMail($to, $subject, false, $msg);
        return $msg;
    }

    $writeCommand('QUIT');
    fgets($socket, 512);
    fclose($socket);

    logSuccess('smtpSend success', ['to' => $to, 'subject' => $subject, 'host' => $host, 'port' => $port]);
    logMail($to, $subject, true);
    return true;
}

function sendAppMail($to, $subject, $body) {
    return smtpSend($to, $subject, $body);
}
