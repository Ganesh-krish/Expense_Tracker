<div class="page-header">
    <h1>Edit Category</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo BASE_URL; ?>categories" id="category-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id'] ?? ''); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="50" value="<?php echo htmlspecialchars($category['name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="type" id="type-income" value="<?php echo CATEGORY_TYPE_INCOME; ?>" <?php echo (($category['type'] ?? 2) == CATEGORY_TYPE_INCOME) ? 'checked' : ''; ?>>
                    <label class="btn btn-outline-success" for="type-income">Income</label>
                    <input type="radio" class="btn-check" name="type" id="type-expense" value="<?php echo CATEGORY_TYPE_EXPENSE; ?>" <?php echo (($category['type'] ?? 2) == CATEGORY_TYPE_EXPENSE) ? 'checked' : ''; ?>>
                    <label class="btn btn-outline-danger" for="type-expense">Expense</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <select class="form-select" id="icon" name="icon">
                    <option value="bi-tag" <?php echo (($category['icon'] ?? '') == 'bi-tag') ? 'selected' : ''; ?>>Tag</option>
                    <option value="bi-briefcase" <?php echo (($category['icon'] ?? '') == 'bi-briefcase') ? 'selected' : ''; ?>>Briefcase</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="color" class="form-control form-control-color" id="color" name="color" value="<?php echo htmlspecialchars($category['color'] ?? '#000000'); ?>">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="<?php echo BASE_URL; ?>categories" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
