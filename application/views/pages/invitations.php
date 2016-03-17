<?php $this->load->view('template/_header', [
    'title' => 'Invitations'
]) ?>

<!-- content -->
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2 invitations-container">
            <?php if(isset($invitations) && $invitations != null): ?>
                <h2>(<?=$invitations->total()?>) friend <?=$invitations->total() > 1? 'requests': 'request'?></h2>
                <hr>
                <?php $this->load->view('pages/partials/_invitations-grid', compact('invitations')) ?>
            <?php else: ?>
                <h1 id="no-notif-text" class="text-center">
                    <i class="fa fa-user"></i> All caught up
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
        function updateInvitationsCount() {
            $.ajax({
                url: '<?=base_url('invitations-count-unseen')?>',
                dataType: 'json',
                success: function(data) {
                    $('.invite-count').attr('data-hint', data.hint);
                    $('.invite-count').html(data.count);
                }
            })
        }
        updateInvitationsCount();

        function nextResults() {
            if((($('#main').scrollTop() + $('#main').innerHeight()) >= $('#main')[0].scrollHeight) && (nextPageUrl != null && nextPageUrl != '')) {
                $.ajax({
                    url: nextPageUrl,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('#main').off('scroll', nextResults);
                        $('.invitations-container').append('<?=Html::morePostsLoader()?>');
                    },
                    success: function(data) {
                        if(data.error == false) {
                            $('.invitations-container').append(data.grid);
                            nextPageUrl = data.nextPageUrl;
                            updateInvitationsCount();
                        } else {
                            alertError(data.message);
                        }
                    }
                }).always(function() {
                    $('.invitations-container').find('.more-posts-loader').remove();
                    $('#main').on('scroll', nextResults);
                });
            }
        }
        $('#main').on('scroll', nextResults);
    });
</script>

<?php $this->load->view('template/_closing-body') ?>

