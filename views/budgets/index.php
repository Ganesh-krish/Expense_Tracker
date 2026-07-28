<div class="page-header">
    <h1>Budgets</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBudgetModal"><i class="bi bi-plus-circle"></i> Set Budget</button>
</div>

<div class="mb-3">
    <label for="month-selector" class="form-label">Select Month</label>
    <input type="month" class="form-control" id="month-selector" name="month" style="max-width: 300px;">
</div>

<div class="row" id="budgets-list">
    <!-- Budgets will be loaded here -->
</div>

<div class="modal fade" id="addBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-budget-form">
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select category</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Budget Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required min="0.01">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Budget</button>
                </form>
            </div>
        </div>
    </div>
</div>
