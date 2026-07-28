// budgets.js
$(document).ready(function() {
    loadBudgets();
    
    $('#month-selector').change(function() {
        loadBudgets();
    });
});

function loadBudgets() {
    var month = $('#month-selector').val();
    $.get('<?php echo BASE_URL; ?>budgets/progress?month=' + month, function(data) {
        // TODO: Render budget cards
    });
}

function loadBudgetAlerts() {
    var month = $('#month-selector').val();
    $.get('<?php echo BASE_URL; ?>budgets/alerts?month=' + month, function(data) {
        // TODO: Render alerts
    });
}
