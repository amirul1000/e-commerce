$(document).on('click change','input[name="checkall_pages"]',function()
{
    var checkboxes = $('.idPages');
    if ($(this).is(':checked'))
    {
        checkboxes.prop("checked" , true);
    }
        else
    {
        checkboxes.prop( "checked" , false);
    }
});

$(document).on('click change','input[name="checkall_mpages"]',function()
{
    var checkboxes = $('.idMPages');
    if ($(this).is(':checked'))
    {
        checkboxes.prop("checked" , true);
    }
        else
    {
        checkboxes.prop( "checked" , false);
    }
});

$(document).on('click change','input[name="checkall_groups"]',function()
{
    var checkboxes = $('.idGroups');
    if ($(this).is(':checked'))
    {
        checkboxes.prop("checked" , true);
    }
        else
    {
        checkboxes.prop( "checked" , false);
    }
});

$(document).on('click change','input[name="field_repeat_check"]',function()
{
    if ($('input[name="field_repeat_check"]').is(':checked'))
    {
        $('input[name="field_repeat_date"]').removeAttr("disabled");
    }
        else
    {
        $('input[name="field_repeat_date"]').attr("disabled", "disabled");
    }
});

function close_modal()
{
    $('#mask').fadeOut();
    $('#modal .window').fadeOut();
}

function update_select(key, name, selector)
{
    $('#js_name_'  + selector).val(name);
    $('#js_input_' + selector).val(key);
}

function token_etime(id)
{
    $('#token' + id).html('Loading...');
    $.post(site_url + 'index.php/schedule/token_etime', {id: id},
    function(data)
    {
        if(data.result == "ok")
        {
            $('#token' + id).html(data.refresh);
        }
    }, "json");
}

function delete_post(id)
{
    $('#frame' + id).fadeTo("fast", 0.5);
    $('#frame' + id).slideUp();
    $.post(site_url + 'index.php/schedule/ajax', {action: 'delete-post', id: id},
    function(data)
    {
        if(data.result == "ok")
        {
            /*
            $('#frame' + id).fadeTo("fast", 0.5);
            $('#frame' + id).slideUp();
            */
        }
    }, "json");
}

function delete_job(id_post, id)
{
    $('#frame_group' + id).fadeTo("fast", 0.5);
    $('#frame_group' + id).slideUp();
    $.post(site_url + 'index.php/schedule/ajax', {action: 'delete-job', id_post: id_post, id: id},
    function(data)
    {
        if(data.result == "ok")
        {
            //$('#frame' + id_post).html(data.refresh);
            if(data.refresh == 0)
            {
                $('#frame' + id_post).fadeTo("fast", 0.5);
                $('#frame' + id_post).slideUp();
            }
                else
            {
                /*
                $('#frame_group' + id).fadeTo("fast", 0.5);
                $('#frame_group' + id).slideUp();
                */
            }
        }
    }, "json");
}

function preview_post(id)
{
    $('#preview_post').html($('#modal_loader').html());
    $.post(site_url + 'index.php/schedule/preview', {id: id},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#preview_post').html(data.refresh);
        }
    }, "json");
}

function preview()
{
    var message     = $('#field_message').val();
    var link        = $('#field_link').val();
    var picture     = $('#field_picture').val();
    var name        = $('#field_name').val();
    var caption     = $('#field_caption').val();
    var description = $('#field_description').val();

    $('#modal_field_message').html(message);
    $('#modal_field_picture').attr('src', picture + '?' + Math.random());
    $('#modal_field_name').html(name);
    $('#modal_field_caption').html(caption);
    $('#modal_field_description').html(description);
}

function filter()
{
    var date1 = $('#datepicker-2').val().replace(/\//g, '-');
    var date2 = $('#datepicker-3').val().replace(/\//g, '-');
    var radio = $('input[name=radio_queue]:checked').val();
    var query = window.location.search.substring(1);
    var query = (query)? '?' + query:'';

    if(radio == 1 && date1 != '' && date2 != '')
    {
        window.location = site_url + 'index.php/schedule/index/' + date1 + ',' + date2 + query;
    }
        else if(radio == 0)
    {
        window.location = site_url + 'index.php/schedule' + query;
    }
}

function filter_users()
{
    var radio  = $('input[name=radio_users]:checked').val();
    var search = $('#js_search_user').val();
    var query  = (search)? '?user=' + search:'';
    window.location = site_url + 'index.php/users/index/' + radio + query;
}

function cron_errorlog(id_cron)
{
    $('#cron-error').html($('#modal_loader').html());
    $.post(site_url + 'index.php/schedule/cron_errorlog', {id_cron: id_cron},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#cron-error').html(data.refresh);
        }
    }, "json");
}

function load_jobs_schedule(id_post)
{
    $.post(site_url + 'index.php/schedule/load_jobs_schedule', {id_post: id_post},
    function(data)
    {
        if(data.result == "ok")
        {
            $('#content-post-'+ id_post).html(data.jobs);
        }
    }, "json");
}

function load_frame_schedule(id_post)
{
    $('#edit-post').html($('#modal_loader').html());
    $.post(site_url + 'index.php/schedule/load_frame_schedule', {id_post: id_post},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#edit-post').html(data.refresh);
        }
    }, "json");
}

function load_frame_repeatpost(id_post)
{
    $('#edit-post').html($('#modal_loader').html());
    $.post(site_url + 'index.php/schedule/load_frame_repeatpost', {id_post: id_post},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#edit-post').html(data.refresh);
        }
    }, "json");
}

function repeat_post(id)
{
    var data           = $('#field_date').val();
    var imput_interval = $('#js_input_interval').val();
    var ptype          = $('#field_ptype').val();
    var message        = $('#field_message').val();
    var link           = $('#field_link').val();
    var picture        = $('#field_picture').val();
    var name           = $('#field_name').val();
    var caption        = $('#field_caption').val();
    var description    = $('#field_description').val();
    var repeat_check   = ($('#field_repeat_check').is(':checked'))? 1:0;
    var delete_check   = ($('#field_delete_check').is(':checked'))? 1:0;
    var date_repeat    = $('#field_date_repeat').val();
    var formpost       = $('#field_formpost').val();

    $.post(site_url + 'index.php/schedule/repeat_post', {id: id, data: data, imput_interval: imput_interval, ptype: ptype, message: message, link: link, picture: picture, name: name, caption: caption, description: description, repeat_check: repeat_check, delete_check: delete_check, date_repeat: date_repeat, formpost: formpost},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["message", "link", "picture", "date"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_formpost').html(data.errors_list);

            if(data.done == 1)
            {
                $('#edit-post').html($('#modal_loader').html());
                close_modal();
                location.reload();
            }
        }
    }, "json");
}

function edit_post(id)
{
    var ptype       = $('#field_ptype').val();
    var message     = $('#field_message').val();
    var link        = $('#field_link').val();
    var picture     = $('#field_picture').val();
    var name        = $('#field_name').val();
    var caption     = $('#field_caption').val();
    var description = $('#field_description').val();
    var formpost    = $('#field_formpost').val();

    $.post(site_url + 'index.php/schedule/edit_post', {id: id, ptype: ptype, message: message, link: link, picture: picture, name: name, caption: caption, description: description, formpost: formpost},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["message", "link", "picture"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_formpost').html(data.errors_list);

            if(data.done == 1)
            {
                $('#edit-post').html($('#modal_loader').html());
                close_modal();
                location.reload();
            }
        }
    }, "json");
}

function pause_post(id)
{
    $('#loader-fpause-' + id).show();
    $('#button-fpause-' + id).hide();
    $.post(site_url + 'index.php/schedule/pause_post', {id: id},
    function(data)
    {
        if(data.result == "ok")
        {
            if(data.pause == 1)
            {
                $('#button-fpause-' + id).removeClass('pause');
                $('#button-fpause-' + id).addClass('play');
            }
                else
            {
                $('#button-fpause-' + id).removeClass('play');
                $('#button-fpause-' + id).addClass('pause');
            }

            $('#loader-fpause-' + id).hide();
            $('#button-fpause-' + id).show();
        }
    }, "json");
}

function load_frame_user(id)
{
    $('#add-user').html($('#modal_loader').html());
    $.post(site_url + 'index.php/users/load_frame', {id: id},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#add-user').html(data.refresh);
        }
    }, "json");
}

function add_user()
{
    var name         = $('#field_name').val();
    var email        = $('#field_email').val();
    var admin        = $('#js_input_admin').val();
    var username     = $('#field_username').val();
    var password     = $('#field_password').val();
    var repassword   = $('#field_repassword').val();
    var formuser     = $('#field_formuser').val();
    var fbuserid     = $('#field_fbuserid').val();
    var fbid         = $('#field_fbid').val();
    var appdefault   = ($('#field_appdefault').is(':checked'))? 1:0;
    var limit_pages  = $('#field_limit_pages').val();
    var limit_groups = $('#field_limit_groups').val();

    $.post(site_url + 'index.php/users/add_user', {name: name, email: email, admin: admin, username: username, password: password, repassword: repassword, formuser: formuser, fbuserid: fbuserid, fbid: fbid, appdefault: appdefault, limit_pages: limit_pages, limit_groups: limit_groups},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["name", "email", "username", "password", "repassword"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_formuser').html(data.errors_list);

            if(data.done == 1)
            {
                $('#add-user').html($('#modal_loader').html());
                close_modal();
                location.reload();
            }
        }
    }, "json");
}

function edit_user(id)
{
    var name         = $('#field_name').val();
    var email        = $('#field_email').val();
    var admin        = $('#js_input_admin').val();
    var username     = $('#field_username').val();
    var password     = $('#field_password').val();
    var repassword   = $('#field_repassword').val();
    var formuser     = $('#field_formuser').val();
    var fbuserid     = $('#field_fbuserid').val();
    var fbid         = $('#field_fbid').val();
    var appdefault   = ($('#field_appdefault').is(':checked'))? 1:0;
    var limit_pages  = $('#field_limit_pages').val();
    var limit_groups = $('#field_limit_groups').val();

    $.post(site_url + 'index.php/users/edit_user', {id: id, name: name, email: email, admin: admin, username: username, password: password, repassword: repassword, formuser: formuser, fbuserid: fbuserid, fbid: fbid, appdefault: appdefault, limit_pages: limit_pages, limit_groups: limit_groups},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["name", "email", "username", "password", "repassword"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_formuser').html(data.errors_list);

            if(data.done == 1)
            {
                $('#add-user').html($('#modal_loader').html());
                close_modal();
                location.reload();
            }
        }
    }, "json");
}

function delete_user(id)
{
    $('#frame_user_' + id).fadeTo("fast", 0.5);
    $('#frame_user_' + id).slideUp();
    $.post(site_url + 'index.php/users/delete_user', {id: id},
    function(data)
    {
        if(data.result == "ok")
        {
            //
        }
    }, "json");
}

function status_user(id)
{
    $('#user-status-loader-' + id).show();
	$('#user-status-active-' + id).hide();
	$('#user-status-inactive-' + id).hide();

    $.post(site_url + 'index.php/users/status_user', {id: id},
    function(data)
    {
        if(data.result == "ok")
        {
        	if(data.status == 1)
        	{
        		$('#user-status-active-' + id).show();
        		$('#user-status-inactive-' + id).hide();
        	}
        		else
        	{
        		$('#user-status-active-' + id).hide();
        		$('#user-status-inactive-' + id).show();
        	}

        	$('#user-status-loader-' + id).hide();
        }
    }, "json");
}

function load_frame_group(id)
{
    $('#add-user').html($('#modal_loader').html());
    $.post(site_url + 'index.php/groups/load_frame', {id: id},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#add-user').html(data.refresh);
        }
    }, "json");
}

function add_group()
{
    var name     = $('#field_name').val();
    var pages    = $('input:checkbox:checked[name="field_pages[]"]').map(function(i,n){return $(n).val();}).get();
    var formuser = $('#field_formuser').val();

    $.post(site_url + 'index.php/groups/add_group', {name: name, pages: pages, formuser: formuser},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["name"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_formgroup').html(data.errors_list);

            if(data.done == 1)
            {
                $('#add-user').html($('#modal_loader').html());
                close_modal();
                location.reload();
            }
        }
    }, "json");
}

function edit_group(id)
{
    var name     = $('#field_name').val();
    var pages    = $('input:checkbox:checked[name="field_pages[]"]').map(function(i,n){return $(n).val();}).get();
    var formuser = $('#field_formuser').val();

    $.post(site_url + 'index.php/groups/edit_group', {id: id, name: name, pages: pages, formuser: formuser},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["name"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_formgroup').html(data.errors_list);

            if(data.done == 1)
            {
                $('#add-user').html($('#modal_loader').html());
                close_modal();
                location.reload();
            }
        }
    }, "json");
}

function delete_group(id)
{
    $('#frame_group_' + id).fadeTo("fast", 0.5);
    $('#frame_group_' + id).slideUp();
    $.post(site_url + 'index.php/groups/delete_group', {id: id},
    function(data)
    {
        if(data.result == "ok")
        {
            //
        }
    }, "json");
}

function load_frame_login_via_at()
{
    $('#add-user').html($('#modal_loader').html());
    $.post(site_url + 'index.php/dashboard/load_frame_login_via_at', {},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#add-user').html(data.refresh);
        }
    }, "json");
}

function login_via_at(id, action)
{
    var fbat           = (id)? id:$('#field_fbat').val();
    var formloginviaat = $('#field_formloginviaat').val();
    var action         = (action)? action:0;

    $.post(site_url + 'index.php/dashboard/login_via_at', {fbat: fbat, action: action, formloginviaat: formloginviaat},
    function(data)
    {
        if(data.result == "ok")
        {
            if(action)
            {
                $('#div-saved-token-' + id).remove();
            }
                else
            {
                var index;
                var errors = ["fbat"];
                for (index = 0; index < errors.length; ++index)
                {
                    if(data.errors[errors[index]])
                    {
                        $('#field_' + errors[index]).parent('div').addClass('error');
                    }
                        else
                    {
                        $('#field_' + errors[index]).parent('div').removeClass('error');
                    }
                }

                if(data.errors_list) $('#errors_formloginviaat').html(data.errors_list);

                if(data.done == 1)
                {
                    location.reload();
                }
            }
        }
    }, "json");
}

function load_frame_invite()
{
    $('#add-user').html($('#modal_loader').html());
    $.post(site_url + 'index.php/dashboard/load_frame_invite', {},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#add-user').html(data.refresh);
        }
    }, "json");
}

function send_invite()
{
    var fbid       = $('#field_fbid').val();
    var forminvite = $('#field_forminvite').val();

    $.post(site_url + 'index.php/dashboard/send_invite', {fbid: fbid, forminvite: forminvite},
    function(data)
    {
        if(data.result == "ok")
        {
            var index;
            var errors = ["fbid"];
            for (index = 0; index < errors.length; ++index)
            {
                if(data.errors[errors[index]])
                {
                    $('#field_' + errors[index]).parent('div').addClass('error');
                }
                    else
                {
                    $('#field_' + errors[index]).parent('div').removeClass('error');
                }
            }

            if(data.errors_list) $('#errors_forminvite').html(data.errors_list);

            if(data.done == 1)
            {
                $('#forminvite-form').hide();
                $('#forminvite-btn').hide();
                $('#forminvite-done').show();
                $('#field_fbid').val('');
            }
        }
    }, "json");
}

function load_frame_import_groups()
{
    $('#add-user').html($('#modal_loader').html());
    $.post(site_url + 'index.php/dashboard/load_frame_import_groups', {},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#add-user').html(data.refresh);
        }
    }, "json");
}

function renew_token(id)
{
    $('#' + id).html('Loading...');
    $.post(site_url + 'index.php/dashboard/renew_token', {},
    function(data)
    {
        if(data.result == "ok")
        {
            $('#' + id).html(data.content);
            $('#' + id).removeAttr('onclick');
        }
    }, "json");
}

function check_token_permissions()
{
    $('#add-user').html($('#modal_loader').html());
    $.post(site_url + 'index.php/dashboard/check_token_permissions', {},
    function(data)
    {
        if(data.result == "ok" && data.refresh != '')
        {
            $('#add-user').html(data.refresh);
        }
    }, "json");
}

function ptype(id)
{
    $('#field_ptype').val(id);

    if(id == 1)
    {
        $('#ptype_field_link').hide();
        $('#ptype_field_message').show();
        $('#ptype_field_name').hide();
        $('#ptype_field_description').hide();
        $('#ptype_field_caption').hide();
        $('#ptype_field_picture').hide();

        $('#ptype_field_message_label_1').show();
        $('#ptype_field_message_label_3').hide();

        $('#ptype_field_message_p_1').show();
        $('#ptype_field_message_p_3').hide();
    }
        else if(id == 2)
    {
        $('#ptype_field_link').show();
        $('#ptype_field_message').show();
        $('#ptype_field_name').hide();
        $('#ptype_field_description').hide();
        $('#ptype_field_caption').hide();
        $('#ptype_field_picture').hide();

        $('#ptype_field_name_label_2').show();
        $('#ptype_field_name_label_5').hide();
        $('#ptype_field_name_p_2').show();
        $('#ptype_field_name_p_5').hide();
        $('#ptype_field_message_label_1').show();
        $('#ptype_field_message_label_3').hide();
        $('#ptype_field_message_p_1').show();
        $('#ptype_field_message_p_3').hide();
        $('#ptype_field_description_label_2').show();
        $('#ptype_field_description_label_5').hide();
        $('#ptype_field_description_p_2').show();
        $('#ptype_field_description_p_5').hide();
        $('#ptype_field_picture_label_2').show();
        $('#ptype_field_picture_label_3').hide();
        $('#ptype_field_picture_label_5').hide();
    }
        else if(id == 3 || id == 4)
    {
        $('#ptype_field_link').hide();
        $('#ptype_field_message').show();
        $('#ptype_field_name').hide();
        $('#ptype_field_description').hide();
        $('#ptype_field_caption').hide();
        $('#ptype_field_picture').show();

        $('#ptype_field_message_label_1').hide();
        $('#ptype_field_message_label_3').show();
        $('#ptype_field_message_p_1').hide();
        $('#ptype_field_message_p_3').show();
        $('#ptype_field_picture_label_2').hide();
        $('#ptype_field_picture_label_3').show();
        $('#ptype_field_picture_label_5').hide();
        $('#file1').show();
        $('#file2').hide();
    }
        else if(id == 5)
    {
        $('#ptype_field_link').hide();
        $('#ptype_field_message').hide();
        $('#ptype_field_name').show();
        $('#ptype_field_description').show();
        $('#ptype_field_caption').hide();
        $('#ptype_field_picture').show();

        $('#ptype_field_name_label_2').hide();
        $('#ptype_field_name_label_5').show();
        $('#ptype_field_name_p_2').hide();
        $('#ptype_field_name_p_5').show();
        $('#ptype_field_description_label_2').hide();
        $('#ptype_field_description_label_5').show();
        $('#ptype_field_description_p_2').hide();
        $('#ptype_field_description_p_5').show();
        $('#ptype_field_picture_label_2').hide();
        $('#ptype_field_picture_label_3').hide();
        $('#ptype_field_picture_label_5').show();
        $('#file1').hide();
        $('#file2').show();
    }
}

$(document).ready(function()
{
    $('#main').loadie();

    var options = {
            target: '#output',
            beforeSubmit: function()
            {
                $('#main').loadie(0);
                $('.loadie').show();
            },
            uploadProgress: function(event, position, total, percentComplete)
            {
                $('#main').loadie(percentComplete / 100);
            },
            success: function(responseText, statusText, xhr, $form)
            {
                $('#main').loadie(100 / 100);
                if(responseText.message) alert(responseText.message);
                if(!responseText.message) $('#field_picture').val(responseText.picture);
            },
            resetForm: false,
            dataType: 'json'
        };

        $('.ImageFile').change(function() {
            $('#MyUploadForm').ajaxSubmit(options);
            return false;
        });
});