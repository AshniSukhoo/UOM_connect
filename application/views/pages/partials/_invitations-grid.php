<?php foreach($invitations as $invitation): ?>
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('partials/_single-user-card', ['user' => $invitation->theSender]) ?>
        </div><!--/.col-md-12-->
    </div><!--/.row-->
    <?php $invitation->notified = true; ?>
    <?php $invitation->save(); ?>
<?php endforeach; ?>
