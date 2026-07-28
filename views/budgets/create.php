<div class="page-header">
    <h1>Set Budget</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>budgets" id="budget-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Select category</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="month" class="form-label">Month</label>
                <input type="month" class="form-control" id="month" name="month" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Budget Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required min="0.01">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Budget</button>
                <a href="<?php echo BASE_URL; ?>budgets" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
