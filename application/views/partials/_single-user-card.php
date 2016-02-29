<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img src="<?=$user->profile_picture?>" class="img-responsive">
            </div><!--/.col-md-3-->
            <div class="col-md-9">
                <a href="<?=$user->profile_uri?>" class="poster-name" title="<?=$user->full_name?>"><?=$user->full_name?></a>
                <br>
                <ul class="list-group my-list-group">
                    <li class="list-group-item">
                        <i class="fa fa-calendar"></i> Born on <?=$user->date_of_birth->formatLocalized('%B %d, %Y') ?>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-globe"></i> Country - <?=($user->basicInfo != null && $user->basicInfo->country != '')?$user->basicInfo->country:'No info provided'?>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-building"></i> City - <?=($user->basicInfo != null && $user->basicInfo->city != '')?$user->basicInfo->city:'No info provided'?>
                    </li>
                </ul>
            </div><!--/.col-md-9-->
        </div><!--/.row-->
        <div class="row">
            <div class="text-center">
                <?php if($this->auth->check() && $this->auth->user()->isFriendsWith($user)): ?>
                    <div class="profile-actions-container">
                        <?=Html::unfriendButton($user->id, 'sm')?>
                    </div><!--/.profile-actions-container-->
                <?php elseif($this->auth->check() && $this->auth->user()->hasSentFriendRequestTo($user)): ?>
                    <div class="profile-actions-container">
                        <?=Html::cancelFriendRequestButton($user->id, 'sm')?>
                    </div><!--/.profile-actions-container-->
                <?php elseif($this->auth->check() && $this->auth->user()->hasReceivedFriendRequestFrom($user)): ?>
                    <div class="profile-actions-container">
                        <?=Html::acceptFriendRequestButton($user->id, 'sm')?>
                        <?=Html::ignoreFriendRequestButton($user->id, 'sm')?>
                    </div><!--/.profile-actions-container-->
                <?php elseif($this->auth->check() && $this->auth->user()->notFriendsWith($user)): ?>
                    <div class="profile-actions-container">
                        <?=Html::addAsFriendButton($user->id, 'sm')?>
                    </div><!--/.profile-actions-container-->
                <?php endif; ?>
            </div><!--/.text-center-->
        </div>
    </div><!--/.panel-body-->
</div><!--/.panel panel-default-->
