<?php if($this->keeper->has('notificationError')): ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-times"></i> <?=$this->keeper->get('notificationError')?>
	</div>
<?php endif; ?>

<?php if($this->keeper->has('notificationSuccess')): ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-check"></i> <?=$this->keeper->get('notificationSuccess')?>
	</div>
<?php endif; ?>