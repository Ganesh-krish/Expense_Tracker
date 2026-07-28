<div class="page-header">
    <h1>Add Income</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>incomes" id="income-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required min="0.01">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Select category</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" maxlength="500"></textarea>
            </div>
            <div class="mb-3">
                <label for="source" class="form-label">Source</label>
                <input type="text" class="form-control" id="source" name="source" maxlength="100">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Save Income</button>
                <a href="<?php echo BASE_URL; ?>incomes" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
