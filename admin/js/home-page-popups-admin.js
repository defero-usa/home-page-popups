jQuery(function($){

    const build_search_result = ( popups ) => {
        let times_el = [];
        if ( popups.length === 0 ) {
            $('#ul-search-results').html( `<div class="hpp-upsell-row">
                 <div class="hpp-upsell-notice"><p>Popup do not find, please, verify if it is active.</p></div>
            </div>`);
        } else {
            const list = popups.map(
                ( row ) => {
                    if ( row.schedule.length === 0  ) {
                        times_el.push(`${row.id}`);
                    }

                    return (
                        `<div class="wp-smush-resize-settings-wrap">
                        <div class="hpp-box-settings-row wp-smush-basic ">
                            <div class="hpp-box-settings-col-1">
                                <span class="hpp-settings-label">ID: ${row.id}</span> 
                                <span class="hpp-settings-label"><a href="/wp-admin/post.php?post=${row.id}&action=edit" title="Edit popup">Edit popup</a></span> 
                                <span class="hpp-description">
                                    <img alt="${row.name}" src="${row.desk_popup_img}" class="mw-80" />
                                </span>
                            </div>
                                <div class="hpp-box-settings-col-2" id="column-wp-smush-auto">
                                <div class="popups-details"> 
                                    <label for="wp-smush-auto"><span class="text-strong">Name:</span> ${row.name}</label><br/> 
                                    <label for="wp-smush-auto"><span class="text-strong">Category:</span> ${row.category}</label><br/> 
                                    <label for="wp-smush-auto"><span class="text-strong">Cookie Name:</span> ${row.popupCookieName}</label><br/> 
                                    <label for="wp-smush-auto"><span class="text-strong">Expiration:</span> ${row.popupExpiration} days</label><br/> 
                                    <label for="wp-smush-auto"><span class="text-strong">Redirect Url:</span> ${row.popupRedirectTo} days</label><br/> 
                                    <label for="wp-smush-auto"><span class="text-strong">Schedule:</span></label><br/>
                                    ${
                                        row.schedule.length > 0 ? 
                                        `<label for="wp-smush-auto"> ${row.schedule} <span data-id="${row.id}" class="rm-schedule text-danger cursor-pointer">[remove]</span></label>` :
                                        `<div class="hpp-box-title" id="schedule-${row.id}" > 
                                            <div class="hpp-row">
                                                <div class="hpp-col">
                                                    <input type="text" name="datetimes-${row.id}" />
                                                </div>
                                                <div class="hpp-col">
                                                    <button type="button"  data-id="${row.id}"  class="hpp-button hpp-button-primary add-schedule">Add</button>
                                                </div>
                                            </div>
                                        </div>`
                                    } 
                                </div>
                            </div>
                        </div>
                    </div>`
                    );
                }
            );
            $('#ul-search-results').html(list);
            let i;
            const length = times_el.length;
            for ( i=0; i<length; i++ ) {
                build_daterangepicker( times_el[i] );
            }
        }

    };

    const build_daterangepicker = ( id ) => {
        $(`input[name="datetimes-${id}"]`).daterangepicker({
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD/YY hh:mm A'
            }
        });
    }

    const get_popups = ( name ) => {
        if ( name.length > 0 ) {
            on_load();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'get_popup',
                    name: name
                },
                dataType: 'json',
                success: function( response ) {
                    console.log(response);
                    if ( response.status === 1 ) {
                        build_search_result(response.data);
                    }
                    after_load();
                },
                error: function(request, status_text, error) {
                    after_load();
                    return false;
                }
            });
        }
    }

    const get_schedules = ( ) => {

        console.log('get_schedules');
        on_load();
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'get_schedules',
            },
            dataType: 'json',
            success: function( response ) {
                console.log(response);
                let tbody;
                if ( response.status === 1 ) {
                    if ( response.data.length === 0 ) {
                        tbody = (`
                            <tr class="iedit author-self level-0 post-99 type-hpp status-inactive hentry">
                                <td colspan="5" class="popupName column-popupName has-row-actions column-primary" data-colname="Name">
                                    No schedule popups found. 
                                </td> 
                            </tr>
                        `);
                    } else {
                        tbody = response.data.map(
                            ( row ) => {
                                return (`
                                    <tr id="post-${row.id}" class="iedit author-self level-0 post-99 type-hpp status-inactive hentry">
                                        <td class="popupName column-popupName has-row-actions column-primary" data-colname="Name">
                                            ${row.name}
                                        </td> 
                                        <td class="popupName column-popupName has-row-actions column-primary" data-colname="Name">
                                            ${row.category}
                                        </td>
                                        <td class="popupCookieName column-popupCookieName" data-colname="Cookie Name">
                                            ${row.popupCookieName}
                                        </td>
                                        <td class="popupExpiration column-popupExpiration" data-colname="Cookie Expiration">
                                            ${row.popupExpiration}
                                        </td> 
                                        <td class="schedule column-schedule" data-colname="Schedule">
                                            ${row.schedule}
                                        </td>
                                        <td class="popupExpiration column-popupExpiration" data-colname="Cookie Expiration">
                                            <a target="_blank" href="${row.popupRedirectTo}">${row.popupRedirectTo}</a>
                                        </td> 
                                        <td class="schedule column-schedule" data-colname="Schedule">
                                           <span data-id="${row.id}" class="cancel-schedule text-danger cursor-pointer" title="Remove schedule">[X]</span>
                                        </td>
                                    </tr>
                                `);
                            }
                        );
                    }
                } else {
                    tbody = (`
                            <tr class="iedit author-self level-0 post-99 type-hpp status-inactive hentry">
                                <td colspan="5" class="popupName column-popupName has-row-actions column-primary" data-colname="Name">
                                    No schedule popups found. 
                                </td> 
                            </tr>
                        `);
                }
                $('#the-list').html(tbody);

                after_load();
            },
            error: function(request, status_text, error) {

                after_load();
                return false;
            }
        });
    }

    const remove_popups = ( id, elem ) => {
        if ( parseInt(id) > 0 ) {
            on_load();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'remove_popups',
                    id: id,
                },
                dataType: 'json',
                success: function( response ) {
                    console.log(response);
                    if ( response.status === 1 ) {
                        if ( typeof elem !== 'undefined') {
                            elem.parent()
                            .html(`
                                <div class="hpp-box-title" id="schedule-${id}" > 
                                    <div class="hpp-row">
                                        <div class="hpp-col">
                                            <input type="text" name="datetimes-${id}" />
                                        </div>
                                        <div class="hpp-col">
                                            <button type="button" data-id="${id}" class="hpp-button hpp-button-primary add-schedule">Add</button>
                                        </div>
                                    </div>
                                </div>`
                            );
                            build_daterangepicker(id);
                        }
                        get_schedules();
                    }
                    after_load();
                },
                error: function(request, status_text, error) {
                    after_load();
                    return false;
                }
            });
        }
    }

    const on_load = () => {
        $("#onLoad").html('<div class="hpp-spinner"></div>');
    }
    const after_load = () => {
        $("#onLoad").html('');
    }

    $(document)
    .on('click', '.rm-schedule', function(e){
            remove_popups( $(this).data('id'), $(this) );
        }
    )
    .on('click', '.cancel-schedule', function(e){
            remove_popups( $(this).data('id') );
        }
    )
    .on('keypress', '#search-name', function(e){
            if(e.which === 13){
                get_popups( $.trim($('#search-name').val()) );
            }
        }
    )
    .on('click', '#btn-search', function(e){
            get_popups( $.trim($('#search-name').val()) );
        }
    )
    .on('click', '#btn-update', function(e){
            $('#search-name').val('');
            $('#ul-search-results').html('');
            get_schedules();
        }
    )
    .on('click', '.add-schedule', function(e){
            const id = $(this).data('id');
            const schedule = $(`input[name="datetimes-${id}"]`).val();
            if ( schedule.length > 0 ) {
                on_load();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'schedule_popup',
                        id: id,
                        schedule: schedule,
                    },
                    dataType: 'json',
                    success: function (response) {
                        after_load();
                        console.log('add-schedule');
                        if (response.status === 1) {
                            console.log('append');
                            get_schedules();
                            const parent = $(`#schedule-${id}`);
                            parent
                                .parent()
                                .append(`<label for="wp-smush-auto"> ${schedule} <span data-id="${id}" class="rm-schedule text-danger cursor-pointer">[remove]</span></label>`);
                            parent.remove();
                        } else {
                            alert(response.msg);
                        }
                    },
                    error: function (request, status_text, error) {
                        after_load();
                        return false;
                    }
                });
            }
        }
    )
     .ready(function() {
        const value = $.trim($('#search-name').val())
        if (  value.length > 0 ) {
            get_popups( value );
        }
    });

    get_schedules();
});

