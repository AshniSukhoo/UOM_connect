<div class="row">
    <div class="col-md-2">
        <img src="<?=$notification->theNotifier->profile_picture?>" class="img-responsive" style="width: 55px;margin: auto;">
    </div><!--/.col-md-2-->
    <div class="col-md-10">
        <a href="<?=$notification->theNotifier->profile_uri?>" class="poster-name" style="padding: 0px;">
            <?=$notification->theNotifier->full_name?>
        </a>&nbsp;<?=$notification->content?>
        <br>
        <i class="<?=$notification->icon?>"></i> <a href="<?=base_url($notification->url)?>"><abbr title="<?=$notification->created_at->toRfc822String()?>" class="text-muted post-time"><?=$notification->created_at->diffForHumans()?></abbr></a>
    </div><!--/.col-md-10-->
</div><!--/.row-->
<hr />
<?php $notification->notified = true; ?>
<?php $notification->save(); ?>
