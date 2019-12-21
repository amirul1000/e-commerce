        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf">
            <table class="table-1" id="formloginviaat-form">
                <tr>
                <td colspan="2" style="font-weight:bold;color:#ca0000;"><?=LNG_LOGIN_VIA_AT_INFO;?><br/><br/></td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_ACCESS_TOKEN;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_fbat" value="<?=isset($fbid)? $fbid:'';?>" placeholder="<?=LNG_FIELD_ACCESS_TOKEN_PLACEHOLDER;?>" />
                        </div>
                    </td>
                </tr>
<?php
    if(!empty($tokens))
    {
?>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_LOGIN_WITH;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div style="padding-top: 12px;font-weight: normal;" class="lbl-3 lt">
<?php
        foreach($tokens as $token)
        {
?>
                            <div id="div-saved-token-<?=$token['id'];?>">
                                <a href="javascript:void(0);" style="color:#ca0000;display:inline-block;margin-bottom:5px;" onclick="if(confirm('<?=LNG_CONFIRM_SAVEDTOKEN_DELETE;?>')){ login_via_at(<?=$token['id'];?>, 'del'); }">X</a>
                                <a href="javascript:login_via_at(<?=$token['id'];?>);close_modal();" style="color:#3b5998;display:inline-block;margin-bottom:5px;"><?=$token['user_name'];?></a>
                                <br/>
                            </div>
<?php
        }
?>
                        </div>
                    </td>
                </tr>
<?php
    }
?>
            </table>
            <input type="hidden" id="field_formloginviaat" value="submit" />
            <p id="errors_formloginviaat" class="msg error" style="margin-left:137px;">&nbsp;</p>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CLOSE;?></a>
            <a href="javascript:void(0);" id="formloginviaat-btn" onclick="<?=$button;?>" class="btn btn-close"><?=LNG_LOGIN;?></a>
        </div>