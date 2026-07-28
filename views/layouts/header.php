<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
