<div class="page-header">
    <h1>Profile</h1>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Profile Information</h5>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <img src="<?php echo BASE_URL . ($user['profile_picture'] ?? 'assets/images/uploads/default-avatar.png'); ?>" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="col-md-9">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username'] ?? ''); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
                <p><strong>Member Since:</strong> <?php echo formatDate($user['created_at'] ?? ''); ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Edit Profile</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>profile/update" id="profile-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Change Password</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>profile/change-password" id="password-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</div>

<div class="card border-danger">
    <div class="card-header bg-danger text-white">
        <h5>Danger Zone</h5>
    </div>
    <div class="card-body">
        <p>Once you delete your account, there is no going back. Please be certain.</p>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete Account</button>
    </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone. All your data will be permanently deleted.</p>
                <form id="delete-account-form">
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <div class="mb-3">
                        <label for="confirm_delete" class="form-label">Type DELETE to confirm</label>
                        <input type="text" class="form-control" id="confirm_delete" name="confirm_delete" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete My Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
