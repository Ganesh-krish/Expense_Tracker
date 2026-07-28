// search.js
$(document).ready(function() {
    var searchTimeout;
    
    $('.search-input').on('input', function() {
        var query = $(this).val();
        clearTimeout(searchTimeout);
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(function() {
                performSearch(query);
            }, 300);
        }
    });
    
    $('.search-form').submit(function(e) {
        e.preventDefault();
        var query = $('.search-input').val();
        if (query.length >= 2) {
            window.location.href = '<?php echo BASE_URL; ?>search?q=' + encodeURIComponent(query);
        }
    });
});

function performSearch(query) {
    $.get('<?php echo BASE_URL; ?>search/suggestions?q=' + encodeURIComponent(query), function(data) {
        // TODO: Show suggestions dropdown
    });
}

function loadSearchResults(query, type = 'all') {
    $.get('<?php echo BASE_URL; ?>search/results?q=' + encodeURIComponent(query) + '&type=' + type, function(data) {
        // TODO: Render results
    });
}
