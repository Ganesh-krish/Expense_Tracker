<div class="page-header">
    <h1>Settings</h1>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>General Settings</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>settings/update" id="settings-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <div class="mb-3">
                <label for="currency" class="form-label">Currency</label>
                <select class="form-select" id="currency" name="currency">
                    <?php foreach (AVAILABLE_CURRENCIES as $currency): ?>
                        <option value="<?php echo $currency; ?>" <?php echo ($settings['currency'] ?? DEFAULT_CURRENCY) == $currency ? 'selected' : ''; ?>>
                            <?php echo $currency; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_format" class="form-label">Date Format</label>
                <select class="form-select" id="date_format" name="date_format">
                    <?php foreach (AVAILABLE_DATE_FORMATS as $format): ?>
                        <option value="<?php echo $format; ?>" <?php echo ($settings['date_format'] ?? DEFAULT_DATE_FORMAT) == $format ? 'selected' : ''; ?>>
                            <?php echo $format; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="email_notifications" class="form-label">
                    <input type="checkbox" id="email_notifications" name="email_notifications" value="1" <?php echo ($settings['email_notifications'] ?? 1) ? 'checked' : ''; ?>>
                    Enable Email Notifications
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Data Management</h5>
    </div>
    <div class="card-body">
        <div class="d-flex gap-2">
            <a href="<?php echo BASE_URL; ?>settings/export" class="btn btn-success">Export All Data</a>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clearDataModal">Clear All Data</button>
        </div>
    </div>
</div>

<div class="modal fade" id="clearDataModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Clear All Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>This will permanently delete all your transactions and custom categories. Default categories will be restored.</p>
                <form id="clear-data-form">
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <div class="mb-3">
                        <label for="confirm_clear" class="form-label">Type CLEAR to confirm</label>
                        <input type="text" class="form-control" id="confirm_clear" name="confirm_clear" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Clear All Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
