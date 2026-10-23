<!-- Single Unified Sidebar Element (Offcanvas on Mobile, Static Sidebar on Desktop) -->
<aside class="offcanvas-lg offcanvas-start sidebar-responsive bg-light border-end" tabindex="-1" id="sidebarResponsive" aria-labelledby="sidebarResponsiveLabel">

    <!-- Header: Visible ONLY in offcanvas mobile drawer mode -->
    <div class="offcanvas-header border-bottom d-lg-none">
        <h5 class="offcanvas-title" id="sidebarResponsiveLabel">Hey, There. What you thinkin?</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" data-bs-target="#sidebarResponsive" aria-label="Close"></button>
    </div>

    <!-- Body Container: Wraps account header and navigation options -->
    <div class="p-3">
        <?php if (auth()->loggedIn()): ?>
        <!-- Account Header Component (Shared across desktop and mobile screens) -->
        <header class="d-flex flex-column align-items-center text-center mb-2 border-bottom">
            <figure style="width: 100%; max-width: 120px;" class="">
                <!-- Rounded Avatar Image -->
                <a href="<?= site_url('home') ?>" class="text-decoration-none" title="To Home Page">
                <img src="<?= base_url( auth()->user()->avatar ) ?>" alt="User Avatar" class="img-fluid rounded-circle mb-2" style="aspect-ratio: 1 / 1; object-fit: cover;">
                </a>
                <!-- Username Caption -->
                <figcaption class="fw-bold text-dark">
                    <a href="<?= site_url('home') ?>" class="text-decoration-none link-dark">
                        <p class="mb-0"><?= auth()->user()->first_name ?> <?= auth()->user()->last_name ?></p>
                    </a>
                    <a href="<?= site_url(['profile', 'username' => auth()->user()->username]) ?>" class="text-decoration-none">@<?= auth()->user()->username ?> </a>
                </figcaption>
            </figure>
        </header>
        <!-- Navigation links -->
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- New Note -->
            <a class="btn btn-primary w-100 text-center py-2" href="<?= site_url('notes/new') ?>" role="button" aria-expanded="false">
                <i class="bi bi-journal-plus"></i> Add New
            </a>
            <!-- ADMINISTRATOR Options -->
            <?php if (auth()->user()->inGroup('admin')): ?>
            <!-- Admin Collapsible List Item Container -->
            <li class="nav-item mb-1">
                <!-- The Trigger Button -->
                <a class="nav-link link-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#submenuManagement" role="button">
                    <span><i class="bi bi-person-vcard"></i> Administrator</span>
                    <!-- Simple pure CSS dropdown chevron indicator -->
                    <span class="dropdown-toggle"></span>
                </a>
                <!-- Dashboard Dropdown Content Wrapper -->
                <div class="collapse" id="submenuManagement">
                    <!-- Nested sub-navigation list with custom left indentation -->
                    <ul class="nav nav-pills flex-column ps-3 mt-1 gap-1">
                        <li>
                            <a class="nav-link py-1 small" href="<?= site_url('admin/dashboard') ?>">
                                <span><i class="bi bi-layout-text-window-reverse"></i> Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small" href="#">
                                <span><i class="bi bi-person"></i> User Details</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small" href="<?= site_url('admin/settings') ?>">
                                <span><i class="bi bi-gear"></i> Site Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endif ?>
            <!-- User Navigation Links -->
            <li class="nav-item">
                <a href="<?= site_url('home') ?>" class="nav-link <?= url_is('home') ? 'active' : 'link-dark' ?>">
                    <span><i class="bi bi-layout-wtf"></i> HomeStop</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('notes') ?>" class="nav-link <?= url_is('notes*') ? 'active' : 'link-dark' ?>">
                    <span>
                        <i class="bi bi-journal-text"></i> Notes</span>
                    </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('notebooks') ?>" class="nav-link <?= url_is('notebook*') ? 'active' : 'link-dark' ?>">
                    <span><i class="bi bi-folder"></i> Notebooks</span>
                </a>
            </li>
            <!-- Network List Item Container -->
            <li class="nav-item mb-1">
                <!-- The Trigger Button -->
                <a class="nav-link <?= url_is('network*') ? 'active' : 'link-dark' ?> d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#submenuNetwork" role="button">
                    <span><i class="bi bi-share-fill"></i> Network</span>
                    <span class="dropdown-toggle"></span>
                </a>
                <!-- The Collapsible Content Wrapper -->
                <div class="<?= url_is('network*') ? 'collapse show' : 'collapse' ?>" id="submenuNetwork">
                    <!-- Nested sub-navigation list with custom left indentation -->
                    <ul class="nav nav-pills flex-column ps-3 mt-1 gap-1">
                        <li>
                            <a class="nav-link py-1 small <?= url_is('network/search*') ? 'active' : '' ?>" href="<?= site_url('network/search') ?>">
                                <i class="bi bi-search"></i>
                                <span>Search</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('network/feed*') ? 'active' : '' ?>" href="<?= site_url('network/feed') ?>">
                                <i class="bi bi-rss"></i>
                                <span>Feed</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('network/follow*') ? 'active' : '' ?>" href="<?= site_url('network/following') ?>">
                                <i class="bi bi-person-fill-add"></i>
                                <span>Followers</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('network/friends*') ? 'active' : '' ?>" href="<?= site_url('network/friends') ?>">
                                <i class="bi bi-people-fill"></i>
                                <span>Friends</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Activity & Feed Collapsible List Item Container -->
            <li class="nav-item mb-1">
                <!-- The Trigger Button -->
                <a class="nav-link <?= url_is('activity*') ? 'active' : 'link-dark' ?> d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#submenuActivity" role="button" aria-expanded="false"
                    aria-controls="submenuActivity">
                    <span><i class="bi bi-broadcast"></i> Activity</span>
                    <span class="dropdown-toggle"></span>
                </a>
                <!-- 2. The Collapsible Content Wrapper -->
                <div class="<?= url_is('activity*') ? 'collapse show' : 'collapse' ?>" id="submenuActivity">
                    <!-- Nested sub-navigation list with custom left indentation -->
                    <ul class="nav nav-pills flex-column ps-3 mt-1 gap-1">
                        <li>
                            <a class="nav-link py-1 small <?= url_is('activity/notifications*') ? 'active' : '' ?>" href="<?= site_url('activity/notifications') ?>">
                                <span><i class="bi bi-bell-fill"></i> Notifications</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('activity/comments*') ? 'active' : '' ?>" href="<?= site_url('activity/comments') ?>">
                                <i class="bi bi-chat-square-dots"></i>
                                <span>Comments</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('activity/pinned*') ? 'active' : '' ?>" href="<?= site_url('activity/pinned') ?>">
                                <i class="bi bi-pin-angle-fill"></i>
                                <span>Pinned</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('activity/log*') ? 'active' : '' ?>" href="<?= site_url('activity/log') ?>">
                                <span><i class="bi bi-graph-up"></i> Activity Log</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <!-- Account Item Container -->
            <li class="nav-item mb-1">
                <!-- The Trigger Button -->
                <a class="nav-link <?= url_is('account*') ? 'active' : 'link-dark' ?> d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#submenuAccount" role="button">
                    <span><i class="bi bi-person-circle"></i> Account</span>
                    <span class="dropdown-toggle"></span>
                </a>
                <!-- The Collapsible Content Wrapper -->
                <div class="<?= url_is('account*') ? 'collapse show' : 'collapse' ?>" id="submenuAccount">
                    <!-- Nested sub-navigation list with custom left indentation -->
                    <ul class="nav nav-pills flex-column ps-3 mt-1 gap-1">
                        <li>
                            <a class="nav-link py-1 small <?= url_is('account') ? 'active' : '' ?>" href="<?= site_url('account') ?>">
                                <i class="bi bi-file-person"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('account/settings') ? 'active' : '' ?>" href="<?= site_url('account/settings') ?>">
                                <i class="bi bi-person-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link py-1 small <?= url_is('account/privacy') ? 'active' : '' ?>" href="<?= site_url('account/privacy') ?>">
                                <i class="bi bi-person-lock"></i>
                                <span>Privacy Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <?php else: ?>
        <div class="sidebarbottom-content text-center pt-5">
            <?php if (setting('Auth.allowRegistration') && !auth()->user()): ?>
                <div class="image">
                    <img src="<?= base_url('assets/images/kuma-avatar.webp') ?>" class="img-fluid" alt="Explort the App?">
                </div>
                <a href="<?= url_to('login') ?>" class="btn btn-primary mt-3 mb-1">
                    Explort the App
                </a>
                <p class="mb-0">To get started sharing your own notes.</p>
            <?php endif ?>
        </div>
        <?php endif ?>
    </div>
</aside>