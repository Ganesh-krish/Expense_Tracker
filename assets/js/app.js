// App.js - Global JavaScript
$(document).ready(function() {
    // CSRF Token for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf_token"]').val()
        }
    });
    
    // Sidebar toggle
    $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('show');
    });
    
    // Close sidebar when clicking outside on mobile
    $(document).click(function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('.sidebar, #sidebarToggle').length) {
                $('.sidebar').removeClass('show');
            }
        }
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Confirm delete actions
    $('.confirm-delete').click(function(e) {
        if (!confirm('Are you sure you want to delete this item?')) {
            e.preventDefault();
        }
    });
    
    // Form validation helper
    window.validateForm = function(formId) {
        var form = $(formId);
        if (form[0].checkValidity()) {
            return true;
        }
        form.addClass('was-validated');
        return false;
    };
    
    // Format currency
    window.formatCurrency = function(amount, currency) {
        var symbols = {
            'USD': '$', 'EUR': '€', 'GBP': '£', 'INR': '₹',
            'JPY': '¥', 'CAD': 'C$', 'AUD': 'A$'
        };
        var symbol = symbols[currency] || '$';
        return symbol + parseFloat(amount).toFixed(2);
    };
});
