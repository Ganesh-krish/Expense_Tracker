<div class="page-header">
    <h1>Categories</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="bi bi-plus-circle"></i> Add Category</button>
</div>

<ul class="nav nav-tabs mb-3" id="categoryTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="income-tab" data-bs-toggle="tab" data-bs-target="#income-categories" type="button">Income Categories</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="expense-tab" data-bs-toggle="tab" data-bs-target="#expense-categories" type="button">Expense Categories</button>
    </li>
</ul>

<div class="tab-content" id="categoryTabContent">
    <div class="tab-pane fade show active" id="income-categories">
        <div class="row" id="income-categories-list">
            <!-- Income categories will be loaded here -->
        </div>
    </div>
    <div class="tab-pane fade" id="expense-categories">
        <div class="row" id="expense-categories-list">
            <!-- Expense categories will be loaded here -->
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-category-form">
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
                            <option value="bi-bus">Bus</option>
                            <option value="bi-house">House</option>
                            <option value="bi-lightning">Lightning</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" value="#000000">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
