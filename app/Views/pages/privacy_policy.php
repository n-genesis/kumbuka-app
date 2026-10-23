<?= $this->extend('layouts/main'); ?>

<?= $this->section('main'); ?>

<!-- Navbar -->
<?= $this->include('partials/top-navbar') ?>
<div class="d-flex flex-column justify-content-between">
    <div class="landing-container">
        <!-- Privacy Policy -->
        <main class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="text-capitalize border-bottom pb-2 mb-3">Privacy Policy</h1>
                    <div class="alert bg-white alert-info" role="alert">
                        <div class="iq-alert-text">
                            <h5 class="alert-heading">Please Note:</h5>
                            <p>"We respect your privacy. Any personal information or data inputted into this application remains your property. However, the software infrastructure and database design used to process this data remain the exclusive intellectual property of the developer under full copyright protection."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">1. Information We Collect</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Because this is a demonstration application, we minimize data collection as much as
                                possible:</p>
                            <ul>
                                <li> <b>User-Submitted Data:</b> If you create a test account, fill out a sample form,
                                    or post mock data, that information is stored in our database purely to demonstrate
                                    application functionality. Please do not enter real, sensitive personal information.
                                </li>
                                <li><b>Automated Technical Data:</b> Like most websites, our server may automatically
                                    log standard technical data such as your IP address, browser type, and the time of
                                    your visit.</li>
                            </ul>

                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">2. Cookies and Sessions</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>This application uses standard, built-in CodeIgniter session cookies (such as
                                `ci_session`) to ensure the website functions correctly, maintains your session state,
                                and protects against Cross-Site Request Forgery (CSRF) attacks. These cookies do not
                                track your browsing habits outside of this site.</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">3. How Your Data is Used and Shared</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Any data you enter into this application is used strictly to display the app's features.
                                We do not sell, rent, trade, or share your data with any third parties.</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Data Retention and Security</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Data entered into this demonstration site is considered temporary and may be deleted or
                                reset at any time without notice. While we implement standard framework security
                                measures, this site is not intended to secure highly sensitive data.</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Contact Information</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>If you have any questions about this project or the CodeIgniter implementation, please
                                contact the me via GIthub or ngendesign@email.com/<a
                                    href="https://github.com/n-genesis/kumbuka-app">GitHub Repo</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Include footer tag -->
<?= $this->include('partials/footer') ?>
<!-- END Main -->
<?= $this->endSection(); ?>