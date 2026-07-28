// Incomes.js
$(document).ready(function() {
    loadIncomes();
    loadIncomeCategories();
    
    $('.filter-form').submit(function(e) {
        e.preventDefault();
        loadIncomes();
    });
});

function loadIncomes(page = 1) {
    var filters = {
        date_from: $('input[name="date_from"]').val(),
        date_to: $('input[name="date_to"]').val(),
        category_id: $('select[name="category_id"]').val(),
        amount_from: $('input[name="amount_from"]').val(),
        amount_to: $('input[name="amount_to"]').val(),
        search: $('input[name="search"]').val(),
        page: page
    };
    
    $.get('<?php echo BASE_URL; ?>incomes', filters, function(data) {
        // TODO: Render incomes table
    });
}

function loadIncomeCategories() {
    $.get('<?php echo BASE_URL; ?>incomes/categories', function(data) {
        var html = '<option value="">All Categories</option>';
        $.each(data.categories, function(i, category) {
            html += '<option value="' + category.id + '">' + category.name + '</option>';
        });
        $('select[name="category_id"]').html(html);
    });
}

function deleteIncome(id) {
    if (confirm('Are you sure you want to delete this income?')) {
        $.ajax({
            url: '<?php echo BASE_URL; ?>incomes',
            method: 'DELETE',
            data: { id: id, csrf_token: $('input[name="csrf_token"]').val() },
            success: function(response) {
                alert(response.message);
                loadIncomes();
            }
        });
    }
}
