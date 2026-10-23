<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg bg-primary border-bottom fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- Mobile Sidebar Toggle (Shows offcanvas on small screens) -->
        <button class="btn border border-light d-lg-none me-2 navbar-toggler-icon-custom" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#sidebarResponsive" aria-controls="sidebarResponsive">
            <i class="bi bi-three-dots-vertical text-white"></i>
        </button>

        <a class="navbar-brand" href="<?= site_url('home') ?>"><?= $appName ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Top Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <?php if (auth()->loggedIn()): ?>
                    <?php if(url_is('/home')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/') ?>">Home Page</a>
                    </li>
                    <?php else: ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('home') ?>">Dashboard</a>
                    </li>
                    <?php endif ?>
                <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('about_kumbuka') ?>">About Kumbuka</a>
                    </li>
            </ul>
            <!-- Right side nav options -->
            <ul class="navbar-nav ms-auto">
                <!-- Landing page links -->
                <?php if(url_is('/')): ?>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Top</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#architecture">Backend Tech</a></li>
                    <?php if (!auth()->loggedIn()): ?>
                    <li class="nav-item mx-2 d-flex align-items-center mb-2 mb-sm-0">
                        <a class="btn btn-outline-light btn-sm" href="<?= site_url('login') ?>">Sign In</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="btn btn-outline-light btn-sm" href="<?= site_url('register') ?>">Get Started</a>
                    </li>
                    <?php endif ?>
                </ul>
                <?php endif ?> 
                <?php if (auth()->loggedIn()): ?>
                <li class="nav-item dropdown" data-bs-theme="light">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-rolodex d-lg-none"></i>
                        <span class="ms-2">Account</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?= site_url(['profile', 'username' => auth()->user()->username]) ?>">
                            <i class="bi bi-person-circle"></i>
                            <span>My Profile</span>
                        </a>
                        <a class="dropdown-item" href="<?= site_url('account') ?>">
                            <i class="bi bi-file-person"></i>
                            <span>
                                Edit Profile </span>
                        </a>
                        <a class="dropdown-item" href="<?= site_url('account/settings') ?>">
                            <i class="bi bi-person-gear"></i>
                            <span>
                                Account Settings </span>
                        </a>
                        <a class="dropdown-item" href="<?= site_url('account/privacy') ?>">
                            <i class="bi bi-person-lock"></i>
                            <span>
                                Privacy Settings </span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                    </div>
                </li>
                <?php endif ?>
                <!-- <li class="nav-item dropdown" data-bs-theme="light">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="theme-menu" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                    <i class="bi bi-circle-half"></i>
                    <span class="d-lg-none ms-2">Toggle theme</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                        <i class="bi bi-sun-fill"></i><span class="ms-2">Light</span>
                    </button>
                    </li>
                    <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="true">
                        <i class="bi bi-moon-stars-fill"></i><span class="ms-2">Dark</span>
                    </button>
                    </li>
                </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>