        <div class="heading">
            <h2>Post preview</h2>
        </div>
        <div class="inner cf">
            <div class="col lt">
                <span class="img"><img src="<?=$fb_image;?>" width="50" height="50" alt=""></span>
            </div>
            <div class="col rt cf">
                <p class="name"><?=$fb_name;?></p>
                <p class="txt-1" id="modal_field_message"><?=$this->general->spintax($message);?></p>
                <span class="img"><img id="modal_field_picture" src="<?=$this->general->spintax($picture);?>" width="90" height="90" alt=""></span>
                <div class="details">
                    <p class="name" id="modal_field_name"><?=$this->general->spintax($name);?></p>
                    <p class="txt-2" id="modal_field_caption"><?=$this->general->spintax($caption);?></p>
                    <p class="txt-2" id="modal_field_description"><?=$this->general->spintax($description);?></p>
                </div>
                <ul>
                    <li><span class="link">Like</span></li>
                    <li><span class="link">Comment</span></li>
                    <li><span class="link">Follow post</span></li>
                    <li>About a minute ago via App</li>
                </ul>
            </div>
        </div>
        <div class="actions">
            <a href="javascript:void(0);" onclick="close_modal();" class="btn rt btn-close">Close preview</a>
        </div>