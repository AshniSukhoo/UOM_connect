<?php $this->load->view('template/_header', [
    'title' => 'Notifications'
]) ?>

<!-- content -->
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <?php if(isset($notifications) && $notifications != null): ?>
                <?php $this->load->view('pages/partials/_notifications-grid', compact('notifications')) ?>
            <?php else: ?>
                <h1 id="no-notif-text" class="text-center">
                    <i class="fa fa-bell"></i> All caught up
                </h1>
            <?php endif; ?>
        </div><!--/.col-md-8-->

    </div><!--/.row-->
</div><!--/.container-->

<?php $this->load->view('template/_footer') ?>

<script type="text/javascript">
    var nextPageUrl = '<?=$nextPageUrl?>';
</script>
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>

<?php $this->load->view('template/_closing-body') ?>

