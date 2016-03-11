<!-- sidebar -->
<div class="column col-sm-1 col-xs-1 sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li>
            <a href="javascript:;" data-toggle="offcanvas" class="visible-xs text-center">
                <i class="fa fa-chevron-right"></i>
            </a>
        </li>
    </ul>
    <ul class="nav hidden-xs" id="lg-menu">
	    <li>
		    <a href="<?=base_url()?>" class="hint--warning hint--bottom" data-hint="News feed">
			    <i class="fa fa-list-alt"></i>
		    </a>
	    </li>
        <li>
	        <a href="<?=base_url('invitations')?>" class="hint--warning hint--bottom" data-hint="<?=($this->auth->user()->hasPendingFriendRequests())?$this->auth->user()->pendingFriendRequests().' pending Friend Requests':'No Friend Request'?>">
		        <i class="fa fa-user-plus"></i>
		        <?php if($this->auth->user()->hasPendingFriendRequests()): ?>
			        <span class="label label-danger"><?=$this->auth->user()->pendingFriendRequests()?></span>
		        <?php endif; ?>
	        </a>
        </li>
        <li>
	        <a href="<?=base_url('notifications')?>" class="hint--warning hint--bottom" data-hint="<?=($this->auth->user()->hasPendingNotifications())?$this->auth->user()->pendingNotifications().' pending notifications':'No new notifications'?>">
		        <i class="fa fa-bell"></i>
		        <?php if($this->auth->user()->hasPendingNotifications()): ?>
			        <span class="label label-danger"><?=$this->auth->user()->pendingNotifications()?></span>
		        <?php endif; ?>
	        </a>
        </li>
    </ul>
    <ul class="list-unstyled hidden-xs" id="sidebar-footer">
    </ul>

    <!-- tiny only nav-->
    <ul class="nav visible-xs" id="xs-menu">
        <li>
	        <a href="<?=base_url()?>" class="text-center">
		        <i class="fa fa-list-alt"></i>
	        </a>
        </li>
        <li>
	        <a href="<?=base_url('invitations')?>" class="text-center">
		        <i class="fa fa-user-plus"></i>
	        </a>
        </li>
        <li>
	        <a href="<?=base_url('notifications')?>" class="text-center">
		        <i class="fa fa-bell"></i>
	        </a>
        </li>
    </ul>
</div>
<!-- /sidebar -->
