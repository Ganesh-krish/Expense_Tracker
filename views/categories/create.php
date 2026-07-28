<div class="page-header">
    <h1>Add Category</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>categories" id="category-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="50">
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="type" id="type-income" value="<?php echo CATEGORY_TYPE_INCOME; ?>" checked>
                    <label class="btn btn-outline-success" for="type-income">Income</label>
                    <input type="radio" class="btn-check" name="type" id="type-expense" value="<?php echo CATEGORY_TYPE_EXPENSE; ?>">
                    <label class="btn btn-outline-danger" for="type-expense">Expense</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <select class="form-select" id="icon" name="icon">
                    <option value="bi-tag">Tag</option>
                    <option value="bi-briefcase">Briefcase</option>
                    <option value="bi-laptop">Laptop</option>
                    <option value="bi-gift">Gift</option>
                    <option value="bi-utensils">Utensils</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="color" class="form-control form-control-color" id="color" name="color" value="#000000">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Category</button>
                <a href="<?php echo BASE_URL; ?>categories" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
