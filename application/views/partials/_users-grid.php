<?php foreach($users as $user): ?>
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('partials/_single-user-card', compact('user')) ?>
        </div><!--/.col-md-12-->
    </div><!--/.row-->
<?php endforeach; ?>
