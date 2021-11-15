jQuery(function($){

    const get_categories = ( ) => {
        on_load();
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'get_categories',
            },
            dataType: 'json',
            success: function( response ) {
                console.log(response);
                let tbody;
                if ( response.status === 1 ) {
                    if ( response.data.length === 0 ) {
                        tbody = (`
                            <tr class="iedit author-self level-0 post-99 type-hpp status-inactive hentry">
                                <td colspan="3" class="popupName column-popupName has-row-actions column-primary" data-colname="Name">
                                    No categories found. 
                                </td> 
                            </tr>
                        `);
                    } else {
                        tbody = response.data.map(
                            ( row, index ) => {
                                return (`
                                    <tr id="post-${index}" class="iedit author-self level-0 post-99 type-hpp status-inactive hentry">
                                        <td class="popupName column-category has-row-actions column-primary" data-colname="category">
                                            ${row.category}
                                        </td> 
                                        <td class="popupName column-description has-row-actions column-primary" data-colname="description">
                                            ${row.description}
                                        </td> 
                                        <td class="schedule column-schedule" data-colname="Schedule">
                                           <span data-category="${row.category}" class="remove-category text-danger cursor-pointer" title="Remove schedule">[X]</span>
                                        </td>
                                    </tr>
                                `);
                            }
                        );
                    }
                } else {
                    tbody = (`
                            <tr class="iedit author-self level-0 post-99 type-hpp status-inactive hentry">
                                <td colspan="3" class="popupName column-popupName has-row-actions column-primary" data-colname="Name">
                                    No categories found. 
                                </td> 
                            </tr>
                        `);
                }
                $('#tb-categories').html(tbody);

                after_load();
            },
            error: function(request, status_text, error) {
                after_load();
                return false;
            }
        });
    }

    const on_load = () => {
        $("#onLoad").html('<div class="hpp-spinner"></div>');
    }
    const after_load = () => {
        $("#onLoad").html('');
    }

    $(document)
    .on('click', '.remove-category', function(e){
        on_load();
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'remove_category',
                category: $(this).data('category'),
            },
            dataType: 'json',
            success: function( response ) {
                console.log(response);
                if ( response.status === 1 ) {
                    get_categories();
                }
                after_load();
            },
            error: function(request, status_text, error) {
                after_load();
                return false;
            }
        });
    })
    .on('click', '#btn-add-category', function(e){
        const category= $.trim($('#category').val());
        $('#add-category-msg').html('');
        if ( category.length > 0 ) {
            on_load();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'hpp_add_category',
                    category: category,
                    description: $.trim($('#description').val())
                },
                dataType: 'json',
                success: function( response ) {
                    console.log(response);
                    if ( response.status === 1 ) {
                        $('#category').val('');
                        $('#description').val('');
                        get_categories();
                    } else {
                        $('#add-category-msg').html( `<div class="hpp-upsell-row">
                             <div class="hpp-upsell-notice"><p>${response.msg}</p></div>
                        </div>`);
                    }
                    after_load();
                },
                error: function(request, status_text, error) {
                    return false;
                    after_load();
                }
            });
        }
        }
    );

    get_categories();
});

