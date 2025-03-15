jQuery(document).ready(function($){
    $('#user_tags').select2({
        ajax: {
            url: ajaxurl.ajax_url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    action: 'user_tags_search',
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
        },
        minimumInputLength: 2
    });

    $('#user_tags_filter').select2();
});
