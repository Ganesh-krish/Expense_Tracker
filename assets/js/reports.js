// Reports.js
$(document).ready(function() {
    // Expense report form
    $('#expense-report-form').submit(function(e) {
        e.preventDefault();
        generateExpenseReport();
    });
    
    // Income report form
    $('#income-report-form').submit(function(e) {
        e.preventDefault();
        generateIncomeReport();
    });
    
    // Monthly report form
    $('#monthly-report-form').submit(function(e) {
        e.preventDefault();
        generateMonthlyReport();
    });
});

function generateExpenseReport() {
    var form = $('#expense-report-form');
    $.get('<?php echo BASE_URL; ?>reports/expense', form.serialize(), function(data) {
        $('#expense-report-result').html(data);
    });
}

function generateIncomeReport() {
    var form = $('#income-report-form');
    $.get('<?php echo BASE_URL; ?>reports/income', form.serialize(), function(data) {
        $('#income-report-result').html(data);
    });
}

function generateMonthlyReport() {
    var form = $('#monthly-report-form');
    $.get('<?php echo BASE_URL; ?>reports/monthly', form.serialize(), function(data) {
        $('#monthly-report-result').html(data);
    });
}

function exportReport(type, format) {
    var url = '<?php echo BASE_URL; ?>reports/export/' + format + '?type=' + type;
    window.open(url, '_blank');
}
