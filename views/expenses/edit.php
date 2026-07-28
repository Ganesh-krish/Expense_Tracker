<div class="page-header">
    <h1>Edit Expense</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>expenses" id="expense-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($expense['id'] ?? ''); ?>">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required min="0.01" value="<?php echo htmlspecialchars($expense['amount'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Select category</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required value="<?php echo htmlspecialchars($expense['date'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" maxlength="500"><?php echo htmlspecialchars($expense['description'] ?? ''); ?></textarea>
            </div>
            <?php if (!empty($expense['receipt_image'])): ?>
                <div class="mb-3">
                    <label class="form-label">Current Receipt</label>
                    <div>
                        <img src="<?php echo BASE_URL . htmlspecialchars($expense['receipt_image']); ?>" alt="Receipt" style="max-width: 200px;">
                    </div>
                </div>
            <?php endif; ?>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Expense</button>
                <a href="<?php echo BASE_URL; ?>expenses" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
