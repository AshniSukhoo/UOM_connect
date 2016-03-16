<?php $this->load->view('template/_header', [
    'title' => 'Notifications'
]) ?>

<!-- content -->
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <?php if(isset($notifications) && $notifications != null): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body notifications-grid">
                                <?php $this->load->view('pages/partials/_notifications-grid', compact('notifications')) ?>
                            </div><!--/.panel-body-->
                        </div><!--/panel-->
                    </div><!--/.col-md-12-->
                </div><!--/.row-->
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
    $(document).ready(function() {
        function updateNotificationCount() {
            $.ajax({
                url: '<?=base_url('notifications-count-unseen')?>',
                dataType: 'json',
                success: function(data) {
                    $('.notif-count').attr('data-hint', data.hint);
                    $('.notif-count').html(data.count);
                }
            })
        }
        updateNotificationCount();

        function nextResults() {
            if((($('#main').scrollTop() + $('#main').innerHeight()) >= $('#main')[0].scrollHeight) && (nextPageUrl != null && nextPageUrl != '')) {
                $.ajax({
                    url: nextPageUrl,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('#main').off('scroll', nextResults);
                        $('.notifications-grid').append('<?=Html::morePostsLoader()?>');
                    },
                    success: function(data) {
                        if(data.error == false) {
                            $('.notifications-grid').append(data.grid);
                            nextPageUrl = data.nextPageUrl;
                            updateNotificationCount();
                        } else {
                            alertError(data.message);
                        }
                    }
                }).always(function() {
                    $('.notifications-grid').find('.more-posts-loader').remove();
                    $('#main').on('scroll', nextResults);
                });
            }
        }
        $('#main').on('scroll', nextResults);
    });
</script>

<?php $this->load->view('template/_closing-body') ?>

