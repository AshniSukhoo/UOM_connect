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
                    <?php if($user->isStudent()): ?>
                        <li class="list-group-item">
                            <i class="fa fa-university"></i> Faculty - <?=$user->uomId->faculties()->first()->name?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-graduation-cap"></i> Course - <?=$user->uomId->courses()->first()->course_name?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i> Born on <?=$user->date_of_birth->formatLocalized('%B %d, %Y') ?>
                        </li>
                    <?php else: ?>
                    <?php endif; ?>
                </ul>
            </div><!--/.col-md-9-->
        </div><!--/.row-->
        <div class="row">
            <div class="text-right">
                <?php if($this->auth->check() && $this->auth->user()->isNot($user)): ?>
                    <div class="profile-actions-container">
                        <?php if($this->auth->user()->isFriendsWith($user)): ?>
                            <?=Html::unfriendButton($user->id, 'sm')?>
                        <?php elseif($this->auth->user()->hasSentFriendRequestTo($user)): ?>
                            <?=Html::cancelFriendRequestButton($user->id, 'sm')?>
                        <?php elseif($this->auth->user()->hasReceivedFriendRequestFrom($user)): ?>
                            <?=Html::acceptFriendRequestButton($user->id, 'sm')?>
                            <?=Html::ignoreFriendRequestButton($user->id, 'sm')?>
                        <?php elseif($this->auth->user()->notFriendsWith($user)): ?>
                            <?=Html::addAsFriendButton($user->id, 'sm')?>
                        <?php endif; ?>
                    </div><!--/.profile-actions-container-->
                <?php endif; ?>
            </div><!--/.text-center-->
        </div>
    </div><!--/.panel-body-->
</div><!--/.panel panel-default-->
