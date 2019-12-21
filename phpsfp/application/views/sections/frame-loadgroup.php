        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf" id="loadgroup">
            <table class="table-1">
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_NAME;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_name" value="<?=isset($name)? $name:'';?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_GROUPS;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="w300 lt" style="width: 300px; height: 200px; margin-bottom:10px; overflow-y: scroll;">
<?php
    if(isset($fbaccess['batch_response']['groups']['error']))
    {
?>
                            <p><?=LNG_FACEBOOK_ERROR;?> <?=print_r($fbaccess['batch_response']['groups']['error']);?></p>
                            <br />
<?php
    }
        else if(isset($fbaccess['batch_response']['groups']['data']))
    {
?>
                            <label><input type="checkbox" id="groups" name="checkall_groups"<?=isset($checked)? ' checked="checked"':'';?>> <?=LNG_CHECK_ALL_GROUPS;?> (<?=isset($fbaccess['batch_response']['groups']['data'])? count($fbaccess['batch_response']['groups']['data']):0;?>)</label><br />
<?php
        $fbaccess['batch_response']['groups']['data'] = $this->general->record_sort($fbaccess['batch_response']['groups']['data'], 'name');
        foreach($fbaccess['batch_response']['groups']['data'] as $group)
        {
            $group_name = isset($group['checked'])? urldecode($group['name']):$group['name'];
?>
                            <label><input type="checkbox" class="idGroups" name="field_pages[]" value="<?=$group['id'].'||'.$this->general->xss_post(urlencode($group_name)).'||groups';?>"<?=isset($group['checked'])? ' checked="checked"':'';?> /> <?=$group_name;?></label><br />
<?php
        }
    }
?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_MANAGED_PAGES;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="w300 lt" style="width: 300px; height: 200px; margin-bottom:10px; overflow-y: scroll;">
<?php
    if(isset($fbaccess['batch_response']['mpages']['error']))
    {
?>
                            <p><?=LNG_FACEBOOK_ERROR;?> <?=print_r($fbaccess['batch_response']['mpages']['error']);?></p>
                            <br />
<?php
    }
        else if(isset($fbaccess['batch_response']['mpages']['data']))
    {
?>
                            <label><input type="checkbox" id="mpages" name="checkall_mpages"<?=isset($checked)? ' checked="checked"':'';?>> <?=LNG_CHECK_ALL_MANAGED_PAGES;?> (<?=isset($fbaccess['batch_response']['mpages']['data'])? count($fbaccess['batch_response']['mpages']['data']):0;?>)</label><br />
<?php
        foreach($fbaccess['batch_response']['mpages']['data'] as $page)
        {
            $page_name = isset($page['checked'])? urldecode($page['name']):$page['name'];
?>
                            <label><input type="checkbox" class="idMPages" name="field_pages[]" value="<?=$page['id'].'||'.$this->general->xss_post(urlencode($page_name)).'||pages||'.$page['access_token'];?>"<?=isset($page['checked'])? ' checked="checked"':'';?> /> <?=$page_name;?></label><br />
<?php
        }
    }
?>
                        </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="field_formuser" value="submit" />
            <p id="errors_formgroup" class="msg error" style="margin-left:137px;">&nbsp;</p>
<?php
    if(isset($checked))
    {
?>
            <p class="msg error" style="margin-left:137px;"><?=LNG_NOTICE_ALL_UNCHECKED_DELETE;?></p>
<?php
    }
?>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CANCEL;?></a>
            <a href="javascript:void(0);" onclick="<?=$button;?>" class="btn btn-close"><?=LNG_SUBMIT;?></a>
        </div>