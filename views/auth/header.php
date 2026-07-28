<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/auth.css">
    <?php if (isset($extraCss)) echo $extraCss; ?>
</head>
<body class="auth-page">
    <?php $layout = $layout ?? 'brand-form'; ?>
    <div class="auth-split layout-<?php echo htmlspecialchars($layout); ?>">
        <div class="auth-brand">
            <div class="brand-content">
                <div class="brand-icon">
                    <i class="bi bi-wallet2"></i>
                </div>
                <h1 class="brand-title">Expense Tracker</h1>
                <p class="brand-subtitle">Take control of your finances with smart tracking, budgeting, and reporting.</p>
            </div>
        </div>
        <div class="auth-form-wrap">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="brand-mobile">
                        <i class="bi bi-wallet2"></i> <?php echo APP_NAME; ?>
                    </div>
                    <?php if (isset($pageTitle)): ?>
                        <p class="page-subtitle"><?php echo htmlspecialchars($pageTitle); ?></p>
                    <?php endif; ?>
                </div>
