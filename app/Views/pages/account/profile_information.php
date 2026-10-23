<!-- app/Views/public/user/profile_information.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>

<!-- Main Right Side Content Area -->
<main class="main-content py-4 px-2">
    <div class="container-fluid">

        <!-- Header Component -->
        <header>
            <!-- Breadcrumbs -->
            <?php if (!empty($breadcrumbHtml)): ?>
                <?= $breadcrumbHtml ?>
            <?php endif; ?>

            <!-- Page Header Title -->
            <h2 class="h5 mb-4 text-dark border-bottom pb-2"><?= $pageHeader ?></h2>
        </header>
        <!-- Edit Personal Information -->
        <section id="personal-information">

            <div class="row">
                <!-- Top nav -->
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-fill mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url('account') ?>">Edit Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('account/settings') ?>">Account Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('account/privacy') ?>">Privacy Settings</a>
                        </li>
                    </ul>
                </div>
                <!-- User Cover, Avatar & Social Links -->
                <aside class="col-md-4">
                    <!-- cover Image -->
                    <div class="card mb-3">
                        <header class="card-header py-3">
                            <h5 class="m-0">Cover Image</h5>
                        </header>
                        <div class="card-body d-flex justify-content-center">
                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <div class="profile-img-edit">
                                            <form id="cover-image-form" action="<?= base_url('account/update-cover-image') ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <label for="cover-image-input" role="button">
                                                <img src="<?= base_url($user->cover_image) ?>" class="cover-image-preview img-thumbnail img-fluid rounded" alt="Profile Cover Image">
                                            </label>
                                            <!-- Check if Demo user -->
                                            <?php if(auth()->id() != 3):?>
                                            <div class="my-3">
                                                <input id="cover-image-input" class="form-control" name="cover-image" type="file" accept="image/jpeg, image/png, image/webp" required>
                                            </div>
                                            <?php else: ?>
                                                <div class="alert alert-primary mb-0" role="alert">
                                                    Operation block on guest account
                                                </div>
                                            <?php endif ?>
                                            <p class="mb-0 text-center">Click Image to upload</p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- User Avatar Image -->
                    <div class="card">
                        <header class="card-header py-3">
                            <h5 class="m-0">Avatar Image</h5>
                        </header>
                        <div class="card-body">
                            <div class="text-center">
                                <label for="avatarFile" role="button">
                                <img class="img-fluid rounded-circle mb-2" src="<?= base_url(auth()->user()->avatar) ?>" alt="profile-pic" style="width:80px">
                                </label>
                                <!-- Check if Demo user -->
                                <?php if(auth()->id() != 3):?>
                                <form id="user-avatar-form" action="<?= base_url('account/update-avatar') ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <input type="file" class="form-control" name="user-avatar" id="avatarFile" accept="image/jpeg, image/png, image/webp" hidden>
                                    <label class="btn btn-outline-primary btn-sm" for="avatarFile">
                                        <i class="bi bi-image"></i> Upload Image
                                    </label>
                                </form>
                                <?php else: ?>
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Operation block on guest account
                                    </div>
                                <?php endif ?>
                                <div class="img-extension mt-1">
                                    <div class="d-inline-block align-items-center">
                                        Only <span class="text-primary text-decoration-underline">.jpg</span> <span class="text-primary text-decoration-underline">.png</span> <span class="text-primary text-decoration-underline">.webp</span> allowed
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </aside>

                <!-- General Profile Information -->
                <section class="col-lg-8">

                    <!-- Profile Info Card -->
                    <div class="card">
                        <header class="card-header py-3">
                            <h5 class="m-0">Personal Information</h5>
                        </header>
                        <!-- General Profile Information FORM -->
                        <form action="<?= site_url('account/update') ?>" method="post" class="needs-validation" data-km="form" novalidate>
                            <?= csrf_field() ?>
                            <!-- Profile Info Card Body -->
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row gy-3">
                                        <!-- First, Last Name, & Profile Bio -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="fname">First Name:</label>
                                            <input type="text" class="form-control" name="first_name" id="fname" value="<?= old('first_name', $user->first_name) ?>"
                                                placeholder="First Name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="lname">Last Name:</label>
                                            <input type="text" class="form-control" name="last_name" id="lname" value="<?= old('last_name', $user->last_name) ?>"
                                                placeholder="Last Name" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="bio" class="form-lable mb-2">Profile Bio</label>
                                            <textarea class="form-control" name="bio" id="bio" placeholder="A brief description of yourself..." rows="8" maxlength="700"><?= old('bio', $user->bio) ?></textarea>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?= $user->user_id ?>">

                                        <!-- Optional Information  -->
                                        <div class="col-md-12">
                                            <div class="card border-primary border">
                                                <div class="card-body">
                                                    <h5 class="card-title">Optional</h5>
                                                    <div class="row gy-3">
                                                        <!-- Website and Social Link Optional -->
                                                        <div class="col-md-6">
                                                            <label for="user_website_page" class="form-label">Website</label>
                                                            <input type="text" class="form-control" id="user_website_page" placeholder="" name="website_link"
                                                                value="<?= old('website_link', $user->website_link) ?>">
                                                            <div class="form-text">A person or Business website.</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="social_website">Social Link:</label>
                                                            <input type="text" class="form-control" name="social_link"
                                                                id="social_website"
                                                                value="<?= old('social_link', $user->social_link) ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Footer -->
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary mr-auto">
                                    <i class="bi bi-box-arrow-left"></i> Back Home
                                </a>
                                <!-- Check if Demo user -->
                                <?php if(auth()->id() != 3):?>
                                <button type="submit" class="btn btn-primary" data-km="submit">Save</button>
                                <?php else: ?>
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Operation block on guest account
                                    </div>
                                <?php endif ?>
                            </div>
                        </form><!-- END FORM -->
                    </div>
                </section>
            </div>

        </section>

    </div>
</main>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<!-- Uploading User Avatar Image -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Avatar Image Uplaod
        const fileInput = document.getElementById('avatarFile');
        const avatarForm = document.getElementById('user-avatar-form');
        if (fileInput !== null && avatarForm !== null) {
            fileInput.addEventListener('change', function () {

                avatarForm.submit();
            });
        }

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });

        // Cover Image Uploading
        const fileCoverInput = document.getElementById('cover-image-input');
        const imageForm = document.getElementById('cover-image-form');
        if (fileCoverInput !== null && imageForm !== null) {
            fileCoverInput.addEventListener('change', function () {
                imageForm.submit();
            });
        }

    });
</script>
<?= $this->endSection(); ?>