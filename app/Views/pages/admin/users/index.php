<!-- app/Views/pages/admin/users/edit.php -->
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

            <!-- QuickPick Dashboard Heading -->
            <h2 class="h5 mb-4 text-dark border-bottom pb-2">Your QuickPicks</h2>
        </header>

        <!-- Content Grid -->
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">User List</h4>
                        </div>
                        <a href="<?= site_url('admin/users/create') ?>" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i> Add New User
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="row justify-content-between">
                                <div class="col-sm-6 col-md-6">
                                    <div id="user_list_datatable_info" class="dataTables_filter">
                                        <!--  Search Form  -->
                                        <form class="mr-3 position-relative" action="<?= base_url('admin/users') ?>" method="get">
                                            <div class="form-row d-flex align-items-center">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="search" value="<?= esc($search ?? '') ?>">
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-outline-primary" type="submit">
                                                        <i class="bi bi-search"></i>Search </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="user-list-files d-flex">
                                        <a class="btn btn-success" href="<?= site_url('admin/users') . '?' . http_build_query([
                                            'active' => 'true',
                                            'search' => $search ?? ''
                                            ]) ?>">
                                            <i class="bi bi-person-fill-check"></i> Active Users
                                        </a>
                                        <a class="btn btn-secondary" href="<?= site_url('admin/users') . '?' . http_build_query([
                                            'active' => 'false',
                                            'search' => $search ?? ''
                                            ]) ?>">
                                            <i class="bi bi-person-x-fill"></i> InActive Users
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- User List Table -->
                            <table id="user-list-table" class="table table-striped table text-center align-middle mt-4" role="grid">
                                <!-- Table Header -->
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>username</th>
                                        <th>Email</th>
                                        <th>Groups</th>
                                        <th>Status</th>
                                        <th>Last Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    <?php if (empty($users)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No users found.</td>
                                        </tr>
                                    <?php else: ?>
                                        <!-- User Row -->
                                        <?php foreach ($users as $user): ?>
                                        <!-- User form -->
                                        <form action="<?= base_url('admin/users/delete/' . $user->id) ?>" data-km="form" data-km-username="<?= esc($user->username) ?>" method="post">

                                            <!-- CSRF Protection is mandatory for destructive actions -->
                                            <?= csrf_field() ?>
                                            <!-- This "spoofs" the POST request as a DELETE request -->
                                            <input type="hidden" name="_method" value="DELETE">

                                            <tr class="user_row <?= !isset($user->status) ? '' : 'table-danger' ?> ">
                                                <!-- Profile Image -->
                                                <td class="text-center">
                                                    <a href="<?= site_url(['profile','username' => $user->username]) ?>" title="View <?= esc($user->username) ?>'s Profile">
                                                        <img class="rounded img-fluid avatar-40" src="<?= base_url($user->avatar) ?>" alt="profile image" style="max-width: 40px;">
                                                    </a>
                                                </td>
                                                <td><?= esc($user->username) ?></td>
                                                <td><?= esc($user->email) ?></td>
                                                <td>
                                                    <?php foreach ($user->getGroups() as $group): ?>
                                                        <span class="badge bg-secondary"><?= esc($group) ?></span>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php if ($user->active): ?>
                                                        <span class="badge bg-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <!-- Formated in User Entity class -->
                                                    <?= $user->user_last_active ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="<?= site_url('admin/users/edit/' . $user->id) ?>" class="btn btn-primary"
                                                            data-bs-toggle="tooltip" title="Edit User">
                                                            <i class="bi bi-pencil"></i> Edit
                                                        </a>
                                                        <?php if ($user->id !== auth()->id()): ?>
                                                            <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete User">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </form>
                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- Card Footer & Pagination -->
                    <div class="card-footer text-muted">
                        <!-- Pagination -->
                        <?= $pager->links() ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <b>(<span id="modalUsername" class="text-danger"></span>)</b>? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalBtn"  data-bs-dismiss="modal">Cancel</button>
                <buttom type="button" id="deleteUserBtn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- END User List Content-->

<?= $this->endSection(); ?>

<!-- Show delete confirmation modal script -->
<?= $this->section('scripts') ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const deleteForms = document.querySelectorAll('form[data-km="form"]');
        const deleteModalElement = document.getElementById('deleteModal');

        // 1. Initialize the Bootstrap 5 Modal instance with your options
        const deleteModal = new bootstrap.Modal(deleteModalElement, {
            backdrop: 'static',
            keyboard: false
        });

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                // 2. Open the modal using the native instance
                deleteModal.show();

                // 3. Extract and update the username field
                const username = form.dataset.kmUsername;
                document.getElementById('modalUsername').textContent = username;

                // 4. Handle the dynamic confirmation button click
                // To clean up previous listeners when changing forms, remove the old listener or use a clean swap:
                const deleteUserBtn = document.getElementById('deleteUserBtn');
                
                // Clone the button to completely wipe previous click bindings
                const newDeleteBtn = deleteUserBtn.cloneNode(true);
                deleteUserBtn.parentNode.replaceChild(newDeleteBtn, deleteUserBtn);

                newDeleteBtn.addEventListener('click', function() {
                    newDeleteBtn.innerHTML = 'Loading...';
                    newDeleteBtn.disabled = true; // Confirm button
                    document.getElementById('closeModalBtn').disabled = true; // Disable close button
                    
                    form.submit(); // Submit the form
                });
            });
        });


    });
</script>

<?= $this->endSection() ?>