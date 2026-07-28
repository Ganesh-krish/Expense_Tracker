<nav class="sidebar">
    <div class="sidebar-header">
        <h4><i class="bi bi-wallet2"></i> <?php echo APP_NAME; ?></h4>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="<?php echo BASE_URL; ?>dashboard" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>expenses" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'expenses') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-arrow-up-circle"></i> Expenses
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>incomes" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'incomes') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-arrow-down-circle"></i> Incomes
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>categories" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'categories') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-tags"></i> Categories
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>reports" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'reports') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-bar-chart"></i> Reports
            </a>
        </li>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === ROLE_ADMIN): ?>
        <li>
            <a href="<?php echo BASE_URL; ?>budgets" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'budgets') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-piggy-bank"></i> Budgets
            </a>
        </li>
        <?php endif; ?>
        <li class="mt-3">
            <a href="<?php echo BASE_URL; ?>profile">
                <i class="bi bi-person"></i> Profile
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>settings">
                <i class="bi bi-gear"></i> Settings
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
    </ul>
</nav>
