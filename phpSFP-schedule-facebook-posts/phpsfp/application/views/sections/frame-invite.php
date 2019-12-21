        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf">
            <table class="table-1" id="forminvite-form">
                <tr>
                    <td colspan="2" style="color:#ca0000;"><?=LNG_INVITE_AS_TESTER_INFO1;?> <a href="https://developers.facebook.com/requests/" target="_blank" style="color:#ca0000;"><strong>Facebook</strong></a> <?=LNG_INVITE_AS_TESTER_INFO2;?><br/><br/></td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><a rel="nofollow" target="_blank" href="http://findmyfbid.com/" style="color:#1d2a5b;font-weight: bold;"><?=LNG_FACEBOOK_USER_ID;?></a></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_fbid" value="<?=isset($fbid)? $fbid:'';?>" placeholder="<?=LNG_FACEBOOK_USER_ID_PLACEHOLDER;?>" />
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table-1" id="forminvite-done" style="display:none;">
                <tr>
                    <td colspan="2" align="center">
                        <a href="https://developers.facebook.com/requests/" target="_blank" title="" class="img"><img src="<?=$this->link->template_url('content/invite-as-tester.png');?>" alt=""></a>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="field_forminvite" value="submit" />
            <p id="errors_forminvite" class="msg error" style="margin-left:137px;">&nbsp;</p>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CLOSE;?></a>
            <a href="javascript:void(0);" id="forminvite-btn" onclick="<?=$button;?>" class="btn btn-close"><?=LNG_SEND_INVITE;?></a>
        </div>