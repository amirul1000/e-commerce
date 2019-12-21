        <div class="heading">
            <h2><?=$title;?> - <?=LNG_FACEBOOK_ERRORS_LOG;?></h2>
        </div>
        <div class="inner cf">
<?php
    if(isset($errors) && !empty($errors))
    {
        foreach($errors as $error)
        {
?>
            <p id="errors_formuser" class="msg"><strong><?=LNG_ATTEMPT;?></strong> <?=$error['error'];?></p><br/>
<?php
        }
    }
        else
    {
?>
            <p><?=LNG_NO_ERROR_LOG;?> <?=strtolower($title);?>.</p>
<?php
    }
?>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CLOSE;?></a>
        </div>