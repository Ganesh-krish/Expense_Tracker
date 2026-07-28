// Expenses.js
$(document).ready(function() {
    loadExpenses();
    loadExpenseCategories();
    
    // Apply filters
    $('.filter-form').submit(function(e) {
        e.preventDefault();
        loadExpenses();
    });
    
    // Select all checkbox
    $('#select-all').change(function() {
        $('.expense-checkbox').prop('checked', $(this).prop('checked'));
    });
});

function loadExpenses(page = 1) {
    var filters = {
        date_from: $('input[name="date_from"]').val(),
        date_to: $('input[name="date_to"]').val(),
        category_id: $('select[name="category_id"]').val(),
        amount_from: $('input[name="amount_from"]').val(),
        amount_to: $('input[name="amount_to"]').val(),
        search: $('input[name="search"]').val(),
        page: page
    };
    
    $.get('<?php echo BASE_URL; ?>expenses', filters, function(data) {
        // TODO: Render expenses table
    });
}

function loadExpenseCategories() {
    $.get('<?php echo BASE_URL; ?>expenses/categories', function(data) {
        var html = '<option value="">All Categories</option>';
        $.each(data.categories, function(i, category) {
            html += '<option value="' + category.id + '">' + category.name + '</option>';
        });
        $('select[name="category_id"]').html(html);
    });
}

function deleteExpense(id) {
    if (confirm('Are you sure you want to delete this expense?')) {
        $.ajax({
            url: '<?php echo BASE_URL; ?>expenses',
            method: 'DELETE',
            data: { id: id, csrf_token: $('input[name="csrf_token"]').val() },
            success: function(response) {
                alert(response.message);
                loadExpenses();
            }
        });
    }
}
