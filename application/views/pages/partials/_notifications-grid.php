<?php foreach($notifications as $notification): ?>
    <div class="row">
        <div class="col-md-12">
            <?=$this->load->view('pages/partials/_single-notification', compact('notification'))?>
        </div><!--/.col-md-12-->
    </div><!--/.row-->
<?php endforeach; ?>
