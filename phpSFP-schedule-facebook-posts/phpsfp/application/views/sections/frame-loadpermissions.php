        <div class="heading">
            <h2><?=$title;?></h2>
        </div>
        <div class="inner cf">
            <p style="padding-bottom: 20px;font-size:14px;"><?=LNG_ACCESS_TOKEN_INFO;?></p>
<?php
    if(isset($error))
    {
?>
            <p class="ico error"><?=$error;?></p>
<?php
    }
        else
    {
        $good = 1;
        foreach($perms as $permission => $status)
        {
            if(!$status)
            {
                $good = 0;
?>
            <p class="ico <?=($status)? 'ok':'error';?>"><strong><?=$permission;?></strong> - <?=LNG_PERMISSION_FOR;?> <?=$permission;?> <?=($status)? LNG_PERMISSION_FOR_IS_GRANTED:LNG_PERMISSION_FOR_IS_NOT_GRANTED;?>.</p>
<?php
            }
        }

        if($good)
        {
?>
            <p class="ico ok"><?=LNG_ACCESS_TOKEN_INFO2;?></p>
<?php
        }
    }
?>
            <p style="padding-top: 10px;font-size:12px;line-height:14px;"><?=LNG_REFRESH_DATA_INFO;?></p>
        </div>
        <div class="actions">
            <a href="javascript:close_modal();" class="btn btn-close"><?=LNG_CLOSE;?></a>
            <a href="<?=$rrequest;?>" class="btn btn-close"><?=LNG_REFRESH_DATA;?></a>
        </div>