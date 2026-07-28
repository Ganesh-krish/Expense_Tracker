// Categories.js
$(document).ready(function() {
    loadCategories();
    
    // Add category form
    $('#add-category-form').submit(function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        $.post('<?php echo BASE_URL; ?>categories', formData, function(response) {
            if (response.success) {
                $('#addCategoryModal').modal('hide');
                form[0].reset();
                loadCategories();
                alert(response.message);
            } else {
                alert(response.message || 'Error creating category');
            }
        }).fail(function() {
            alert('Error creating category');
        });
    });
});

function loadCategories() {
    $.get('<?php echo BASE_URL; ?>categories/get-by-type?type=<?php echo CATEGORY_TYPE_INCOME; ?>', function(incomeData) {
        renderCategories(incomeData.categories, 'income-categories-list');
    });
    
    $.get('<?php echo BASE_URL; ?>categories/get-by-type?type=<?php echo CATEGORY_TYPE_EXPENSE; ?>', function(expenseData) {
        renderCategories(expenseData.categories, 'expense-categories-list');
    });
}

function renderCategories(categories, containerId) {
    var html = '';
    $.each(categories, function(i, category) {
        html += '<div class="col-md-4 mb-3">' +
            '<div class="card">' +
            '<div class="card-body">' +
            '<div class="d-flex justify-content-between align-items-center">' +
            '<div>' +
            '<h5 class="card-title"><i class="bi ' + category.icon + '"></i> ' + category.name + '</h5>' +
            (category.is_default ? '<span class="badge bg-secondary">Default</span>' : '') +
            '</div>' +
            '<div>' +
            (!category.is_default ? '<a href="<?php echo BASE_URL; ?>categories/edit/' + category.id + '" class="btn btn-sm btn-primary">Edit</a> ' : '') +
            (!category.is_default ? '<button class="btn btn-sm btn-danger" onclick="deleteCategory(' + category.id + ')">Delete</button>' : '') +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
    });
    $('#' + containerId).html(html);
}

function deleteCategory(id) {
    if (confirm('Are you sure you want to delete this category?')) {
        $.ajax({
            url: '<?php echo BASE_URL; ?>categories',
            method: 'DELETE',
            data: { id: id, csrf_token: $('input[name="csrf_token"]').val() },
            success: function(response) {
                alert(response.message);
                loadCategories();
            }
        });
    }
}
