<div class="page-header">
    <h1>Search Results</h1>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="<?php echo BASE_URL; ?>search" class="row g-3">
            <div class="col-md-10">
                <input type="text" class="form-control" name="q" placeholder="Search transactions..." value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>
</div>

<ul class="nav nav-tabs mb-3" id="searchTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-results" type="button">All</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="income-tab" data-bs-toggle="tab" data-bs-target="#income-results" type="button">Income</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="expense-tab" data-bs-toggle="tab" data-bs-target="#expense-results" type="button">Expense</button>
    </li>
</ul>

<div class="tab-content" id="searchTabContent">
    <div class="tab-pane fade show active" id="all-results">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="search-results">
                            <tr><td colspan="6" class="text-center">Enter a search term to see results</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="income-results">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="income-results-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="expense-results">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="expense-results-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
