<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/vendor/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <?php if (isset($extraCss)) echo $extraCss; ?>
</head>
<body>
    <?php if (isLoggedIn()): ?>
        <?php require_once VIEWS_PATH . 'layouts/sidebar.php'; ?>
        <div class="main-content">
            <?php require_once VIEWS_PATH . 'layouts/navbar.php'; ?>
            <div class="content-wrapper">
    <?php endif; ?>
