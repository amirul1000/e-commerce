        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf">
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
                        <label class="lbl-3"><?=LNG_FIELD_EMAIL;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_email" value="<?=isset($email)? $email:'';?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_USER_TYPE;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 select lt">
                            <input type="text" value="<?=isset($type)? $type:LNG_USER;?>" id="js_name_admin" />
                            <input type="hidden" value="<?=isset($access)? $access:0;?>" id="js_input_admin" />
                            <div class="dropdown">
                                <ul>
                                    <li><a title="" href="javascript:void(0);" onclick="update_select('0', '<?=LNG_USER;?>', 'admin');"><?=LNG_USER;?></a></li>
                                    <li><a title="" href="javascript:void(0);" onclick="update_select('1', '<?=LNG_ADMIN;?>', 'admin');"><?=LNG_ADMIN;?></a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_USERNAME;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_username" value="<?=isset($username)? $username:'';?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_PASSWORD;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="password" id="field_password" value="" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_RE_PASSWORD;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="password" id="field_repassword" value="" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_APP_SCOPED_ID_RESTRICTION;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_fbuserid" value="<?=isset($fbuserid)? $fbuserid:'';?>" />
                        </div>
                    </td>
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
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_FACEBOOK_APP;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div style="padding-top: 12px;font-weight: normal;" class="lbl-3 lt">
                            <input type="checkbox" value="1" <?=isset($appdefault)? (!empty($appdefault)? 'checked="checked"':''):'';?> id="field_appdefault"> <?=LNG_FIELD_FACEBOOK_APP_CHECKBOX;?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_F_PAGES_LIMIT;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_limit_pages" value="<?=isset($limit_pages)? $limit_pages:'';?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_FIELD_F_GROUPS_LIMIT;?></label>
                    </td>
                    <td class="field-wrap" colspan="2">
                        <div class="input-1 w300 lt">
                            <input type="text" id="field_limit_groups" value="<?=isset($limit_groups)? $limit_groups:'';?>" />
                        </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="field_formuser" value="submit" />
            <p id="errors_formuser" class="msg error" style="margin-left:137px;">&nbsp;</p>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CANCEL;?></a>
            <a href="javascript:void(0);" onclick="<?=$button;?>" class="btn btn-close"><?=LNG_SUBMIT;?></a>
        </div>