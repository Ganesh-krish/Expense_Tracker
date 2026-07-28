<div class="dashboard-header">
    <h1>Dashboard</h1>
    <p class="text-muted">Welcome back, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>!</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card summary-card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-wallet2"></i> Total Balance</h6>
                <h3 class="card-text" id="total-balance">$0.00</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card summary-card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-arrow-down-circle"></i> Monthly Income</h6>
                <h3 class="card-text" id="monthly-income">$0.00</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card summary-card bg-danger text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-arrow-up-circle"></i> Monthly Expense</h6>
                <h3 class="card-text" id="monthly-expense">$0.00</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card summary-card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-piggy-bank"></i> Savings</h6>
                <h3 class="card-text" id="monthly-savings">$0.00</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-plus-circle"></i> Quick Add</h5>
            </div>
            <div class="card-body">
                <form id="quick-add-form">
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="type" id="type-expense" value="<?php echo TRANSACTION_TYPE_EXPENSE; ?>" checked>
                            <label class="btn btn-outline-danger" for="type-expense">Expense</label>
                            <input type="radio" class="btn-check" name="type" id="type-income" value="<?php echo TRANSACTION_TYPE_INCOME; ?>">
                            <label class="btn btn-outline-success" for="type-income">Income</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
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
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Transaction</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-graph-up"></i> Expense by Category</h5>
            </div>
            <div class="card-body">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-calendar-month"></i> Monthly Trend</h5>
            </div>
            <div class="card-body">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5><i class="bi bi-list-ul"></i> Recent Transactions</h5>
        <a href="<?php echo BASE_URL; ?>expenses" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="recent-transactions">
                    <tr><td colspan="5" class="text-center">No transactions found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
