<?php $this->load->view('template/_header.php', [
    'hasAd' => true,
    'title' => 'Search results for "'.$this->input->get('srch-term').'"'
]) ?>

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="users-container">
                <h3><?=(isset($results) && $results != null) ? $results->total().' search results for "'.$this->input->get('srch-term').'"' : 'No results found for "'.$this->input->get('srch-term').'"'?></h3>
                <br>
                <?php if(isset($results) && $results != null): ?>
                    <?php $this->load->view('partials/_users-grid', ['users' => $results]) ?>
                <?php else: ?>
                    <div class="text-center">
                        <a href="<?=base_url()?>" class="btn btn-primary btn-lg" style="margin-top: 100px;">
                            Back to Homepage <i class="fa fa-home"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div><!--/.users-container-->
        </div><!--/.col-md-8-->

        <div class="col-md-3">
            <?php $this->load->view('pages/partials/_post-advertisement-template') ?>
        </div><!--/.col-md-4-->
    </div><!--/.row-->
</div><!--/.container-->

<?php $this->load->view('template/_footer') ?>

<?php $this->load->view('partials/_js-user-invitations') ?>

<script type="text/javascript">
    var nextPageUrl = '<?=$nextPageUrl?>';
</script>
<script type="text/javascript">
    $(document).ready(function() {
        function nextResults() {
            if(($('#main').scrollTop() + $('#main').innerHeight() >= $('#main')[0].scrollHeight) && (nextPageUrl != null && nextPageUrl != '')) {
                $.ajax({
                    url: nextPageUrl,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('#main').off('scroll', nextResults);
                        $('.users-container').append('<?=Html::morePostsLoader()?>');
                    },
                    success: function(data) {
                        if(data.error == false) {
                            $('.users-container').append(data.grid);
                            nextPageUrl = data.nextPageUrl;
                            addUsersInvitationActionsToButton();
                        } else {
                            alertError(data.message);
                        }
                    }
                }).always(function() {
                    $('.users-container').find('.more-posts-loader').remove();
                    $('#main').on('scroll', nextResults);
                });
            }
        }
        $('#main').on('scroll', nextResults);
    });
</script>

<?php $this->load->view('template/_closing-body') ?>

