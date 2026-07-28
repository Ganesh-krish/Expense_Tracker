<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="btn btn-link text-white" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>dashboard">
            <i class="bi bi-wallet2"></i> <?php echo APP_NAME; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex mx-auto search-form" action="<?php echo BASE_URL; ?>search" method="GET">
                <input class="form-control me-2" type="search" name="q" placeholder="Search transactions..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>profile"><i class="bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>settings"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
