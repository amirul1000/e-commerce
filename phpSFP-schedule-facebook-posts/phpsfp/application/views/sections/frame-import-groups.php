        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf">
            <form id="MyUploadFormImport" name="formimportgroups" action="<?=site_url('index.php/dashboard/import_groups');?>" method="post" enctype="multipart/form-data">
                <table class="table-1" id="formimportgroups-form">
                    <tr>
                        <td colspan="2"><?=LNG_IMPORT_GROUPS_INFO1;?> <a style="font-weight:bold;color:#ca0000;" href="https://www.facebook.com/bookmarks/groups/" target="_blank"><?=LNG_IMPORT_GROUPS_INFO2;?></a> <?=LNG_IMPORT_GROUPS_INFO3;?><br/><br/></td>
                    </tr>
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3"><?=LNG_FILE;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="input-1 w300 lt" style="height:28px;">
                                <input type="file" name="ImportFile[]" value="" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3"><?=LNG_GROUPS;?></label>
                        </td>
                        <td colspan="2" class="field-wrap">
                            <div style="padding-top: 12px;font-weight: normal;" class="lbl-3 lt">
                                <input type="checkbox" value="1" name="type" checked="checked" /> <?=LNG_IMPORT_GROUPS_FILTER;?>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table-1" id="formimportgroups-loading" style="display:none;">
                    <tr>
                        <td colspan="2" align="center"><img src="<?=$this->link->template_url('content/ajax-loader.gif');?>" /></td>
                    </tr>
                </table>
                <table class="table-1" id="formimportgroups-success" style="display:none;">
                    <tr>
                        <td colspan="2" style="font-weight:bold;color:green;"><?=LNG_IMPORT_GROUPS_FILE_OK;?></td>
                    </tr>
                </table>
                <table class="table-1" id="formimportgroups-error" style="display:none;">
                    <tr>
                        <td colspan="2" style="font-weight:bold;color:#ca0000;"><?=LNG_IMPORT_GROUPS_FILE_NOT_OK;?></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="actions">
            <a href="javascript:location.reload();" class="btn btn-close"><?=LNG_CLOSE;?></a>
            <a href="javascript:void(0);" id="formimportgroups-btn" class="btn btn-close"><?=LNG_IMPORT;?></a>
        </div>
        <script type="text/javascript">
            $(document).ready(function()
            {
                var options = {
                    target: '#outputig',
                    beforeSubmit: function()
                    {
                        //
                    },
                    uploadProgress: function(event, position, total, percentComplete)
                    {
                        $('#formimportgroups-form').hide();
                        $('#formimportgroups-loading').show();
                    },
                    success: function(responseText, statusText, xhr, $form)
                    {
                        if(responseText.done)
                        {
                            $('#formimportgroups-loading').hide();
                            $('#formimportgroups-success').show();
                            $('#formimportgroups-btn').remove();
                        }
                            else
                        {
                            $('#formimportgroups-loading').hide();
                            $('#formimportgroups-error').show();
                            $('#formimportgroups-btn').remove();
                        }
                    },
                    resetForm: false,
                    dataType: 'json'
                };

                $('#formimportgroups-btn').click(function() {
                    $('#MyUploadFormImport').ajaxSubmit(options);
                    return false;
                });
            });
        </script>