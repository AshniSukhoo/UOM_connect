<?php foreach($friends->getCollection()->chunk(2) as $friendRow): ?>
    <div class="row">
        <?php foreach($friendRow as $friend): ?>
            <div class="col-md-6">
                <?php $this->load->view('partials/_single-user-card', [
                    'user' => $friend
                ]) ?>
            </div><!--/.col-md-6-->
        <?php endforeach; ?>
    </div><!--/.row-->
<?php endforeach; ?>
