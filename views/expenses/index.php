<div class="page-header">
    <h1>Expenses</h1>
    <a href="<?php echo BASE_URL; ?>expenses/create" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Expense</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="<?php echo BASE_URL; ?>expenses" class="row g-3">
            <div class="col-md-2">
                <input type="date" class="form-control" name="date_from" placeholder="Date From" value="<?php echo htmlspecialchars($_GET['date_from'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="date_to" placeholder="Date To" value="<?php echo htmlspecialchars($_GET['date_to'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="category_id">
                    <option value="">All Categories</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="amount_from" placeholder="Min Amount" step="0.01" value="<?php echo htmlspecialchars($_GET['amount_from'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="amount_to" placeholder="Max Amount" step="0.01" value="<?php echo htmlspecialchars($_GET['amount_to'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="expenses-table">
                    <tr><td colspan="6" class="text-center">Loading...</td></tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="pagination">
            </ul>
        </nav>
    </div>
</div>
