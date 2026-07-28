<div class="page-header">
    <h1>Reports</h1>
</div>

<ul class="nav nav-tabs mb-3" id="reportTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="expense-tab" data-bs-toggle="tab" data-bs-target="#expense-report" type="button">Expense Report</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="income-tab" data-bs-toggle="tab" data-bs-target="#income-report" type="button">Income Report</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly-report" type="button">Monthly Comparison</button>
    </li>
</ul>

<div class="tab-content" id="reportTabContent">
    <div class="tab-pane fade show active" id="expense-report">
        <div class="card">
            <div class="card-body">
                <form id="expense-report-form" class="row g-3">
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date_from" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date_to" required>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category_id">
                            <option value="">All Categories</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="expense-report-result" class="mt-3"></div>
    </div>
    <div class="tab-pane fade" id="income-report">
        <div class="card">
            <div class="card-body">
                <form id="income-report-form" class="row g-3">
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date_from" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date_to" required>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category_id">
                            <option value="">All Categories</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="income-report-result" class="mt-3"></div>
    </div>
    <div class="tab-pane fade" id="monthly-report">
        <div class="card">
            <div class="card-body">
                <form id="monthly-report-form" class="row g-3">
                    <div class="col-md-4">
                        <input type="month" class="form-control" name="month" required>
                    </div>
                    <div class="col-md-4">
                        <input type="month" class="form-control" name="month_end" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-info w-100">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="monthly-report-result" class="mt-3"></div>
    </div>
</div>
