// Dashboard.js
$(document).ready(function() {
    loadDashboardData();
    loadCategories();
    
    // Quick add form
    $('#quick-add-form').submit(function(e) {
        e.preventDefault();
        
        var form = $(this);
        var type = form.find('input[name="type"]:checked').val();
        var url = type == <?php echo TRANSACTION_TYPE_EXPENSE; ?> ? '<?php echo BASE_URL; ?>dashboard/quick-add-expense' : '<?php echo BASE_URL; ?>dashboard/quick-add-income';
        
        $.post(url, form.serialize(), function(response) {
            if (response.success) {
                alert(response.message);
                form[0].reset();
                loadDashboardData();
            } else {
                alert(response.message || 'Error adding transaction');
            }
        }).fail(function() {
            alert('Error adding transaction');
        });
    });
    
    // Category filter based on type
    $('input[name="type"]').change(function() {
        loadCategories();
    });
});

function loadDashboardData() {
    $.get('<?php echo BASE_URL; ?>dashboard/refresh-data', function(data) {
        if (data.cards) {
            $('#total-balance').text(formatCurrency(data.cards.total_balance));
            $('#monthly-income').text(formatCurrency(data.cards.monthly_income));
            $('#monthly-expense').text(formatCurrency(data.cards.monthly_expense));
            $('#monthly-savings').text(formatCurrency(data.cards.monthly_savings));
        }
        
        if (data.recent_transactions && data.recent_transactions.length > 0) {
            var html = '';
            $.each(data.recent_transactions, function(i, transaction) {
                html += '<tr>' +
                    '<td>' + transaction.date + '</td>' +
                    '<td>' + transaction.description + '</td>' +
                    '<td><span class="badge" style="background-color:' + transaction.category_color + '">' + transaction.category_name + '</span></td>' +
                    '<td class="' + (transaction.type == <?php echo TRANSACTION_TYPE_EXPENSE; ?> ? 'text-danger' : 'text-success') + '">' +
                    (transaction.type == <?php echo TRANSACTION_TYPE_EXPENSE; ?> ? '-' : '+') + formatCurrency(transaction.amount) + '</td>' +
                    '<td><a href="<?php echo BASE_URL; ?>expenses/edit/' + transaction.id + '" class="btn btn-sm btn-primary">Edit</a></td>' +
                    '</tr>';
            });
            $('#recent-transactions').html(html);
        }
        
        // Load charts
        if (data.charts) {
            loadExpenseChart(data.charts.expense_by_category);
            loadTrendChart(data.charts.monthly_trend);
        }
    });
}

function loadCategories() {
    var type = $('input[name="type"]:checked').val();
    $.get('<?php echo BASE_URL; ?>dashboard/get-categories?type=' + type, function(data) {
        var html = '<option value="">Select category</option>';
        $.each(data.categories, function(i, category) {
            html += '<option value="' + category.id + '">' + category.name + '</option>';
        });
        $('#category_id').html(html);
    });
}

function loadExpenseChart(categoryData) {
    var ctx = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: categoryData.labels,
            datasets: [{
                data: categoryData.values,
                backgroundColor: categoryData.colors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function loadTrendChart(trendData) {
    var ctx = document.getElementById('trendChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: trendData.labels,
            datasets: [
                {
                    label: 'Income',
                    data: trendData.income,
                    backgroundColor: '#28a745'
                },
                {
                    label: 'Expense',
                    data: trendData.expense,
                    backgroundColor: '#dc3545'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}
