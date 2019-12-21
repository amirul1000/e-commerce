        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf">
            <table class="table-1" style="margin-bottom: 10px;">
                <tr>
                    <td class="txt-wrap">
                        <label class="lbl-3"><?=LNG_POST_TYPE;?></label>
                    </td>
                    <td colspan="2" class="field-wrap" style="padding-top: 12px;font-weight: normal;">
                        <label class="lbl-2"><input type="radio" disabled="disabled" name="field_ptype" onclick="ptype(1);" value="1"<?=(isset($ptype) && $ptype == 1)? ' checked="checked"':'';?>><?=LNG_TYPE_TEXT_POST;?></label>
                        <label class="lbl-2"><input type="radio" disabled="disabled" name="field_ptype" onclick="ptype(2);" value="2"<?=(isset($ptype) && $ptype == 2)? ' checked="checked"':'';?>><?=LNG_TYPE_LINK;?></label>
                        <label class="lbl-2"><input type="radio" disabled="disabled" name="field_ptype" onclick="ptype(3);" value="3"<?=(isset($ptype) && $ptype == 3)? ' checked="checked"':'';?>><?=LNG_TYPE_IMAGE;?></label>
                        <label class="lbl-2"><input type="radio" disabled="disabled" name="field_ptype" onclick="ptype(5);" value="5"<?=(isset($ptype) && $ptype == 5)? ' checked="checked"':'';?>><?=LNG_TYPE_VIDEO;?></label>
                    </td>
                </tr>
            </table>
            <div id="ptype_field_link">
                <table class="table-1">
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3"><?=LNG_FIELD_LINK_URL;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="input-1 w300 lt">
                                <input type="text" id="field_link" value="<?=isset($link)? $link:'';?>" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="ptype_field_message">
                <table class="table-1">
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3" id="ptype_field_message_label_1"><?=LNG_FIELD_MESSAGE;?></label>
                            <label class="lbl-3" id="ptype_field_message_label_3"><?=LNG_FIELD_IMAGE_DESCRIPTION;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="textarea-1 w300 lt">
                                <textarea id="field_message"><?=isset($message)? $message:'';?></textarea>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="ptype_field_name">
                <table class="table-1">
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3" id="ptype_field_name_label_2"><?=LNG_FIELD_LINK_TITLE;?></label>
                            <label class="lbl-3" id="ptype_field_name_label_5"><?=LNG_FIELD_VIDEO_TITLE;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="input-1 w300 lt">
                                <input type="text" id="field_name" value="<?=isset($name)? $name:'';?>" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="ptype_field_description">
                <table class="table-1">
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3" id="ptype_field_description_label_2"><?=LNG_FIELD_LINK_DESCRIPTION;?></label>
                            <label class="lbl-3" id="ptype_field_description_label_5"><?=LNG_FIELD_VIDEO_DESCRIPTION;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="textarea-1 w300 lt">
                                <textarea id="field_description"><?=isset($description)? $description:'';?></textarea>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="ptype_field_caption">
                <table class="table-1">
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3"><?=LNG_FIELD_LINK_CAPTION;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="input-1 w300 lt">
                                <input type="text" id="field_caption" value="<?=isset($caption)? $caption:'';?>" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="ptype_field_picture">
                <table class="table-1">
                    <tr>
                        <td class="txt-wrap">
                            <label class="lbl-3" id="ptype_field_picture_label_2"><?=LNG_FIELD_PICTURE_URL;?></label>
                            <label class="lbl-3" id="ptype_field_picture_label_3"><?=LNG_FIELD_IMAGE_URL;?></label>
                            <label class="lbl-3" id="ptype_field_picture_label_5"><?=LNG_FIELD_VIDEO_URL;?></label>
                        </td>
                        <td class="field-wrap" colspan="2">
                            <div class="input-1 w300 lt">
                                <input type="text" id="field_picture" value="<?=isset($picture)? $picture:'';?>" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <input type="hidden" id="field_ptype" value="<?=isset($ptype)? $ptype:1;?>" />
            <input type="hidden" id="field_formpost" value="submit" />
            <p id="errors_formpost" class="msg error" style="margin-left:137px;">&nbsp;</p>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CANCEL;?></a>
            <a href="javascript:void(0);" onclick="<?=$button;?>" class="btn btn-close"><?=LNG_SUBMIT;?></a>
        </div>
        <script type="text/javascript">$(document).ready(function(){ ptype(<?=isset($ptype)? $ptype:1;?>); });</script>