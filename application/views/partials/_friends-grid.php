<?php foreach($friends as $friend): ?>
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('partials/_single-user-card', [
                'user' => $friend
            ]) ?>
        </div><!--/.col-md-12-->
    </div><!--/.row-->
<?php endforeach; ?>
