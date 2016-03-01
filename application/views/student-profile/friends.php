<?php $this->load->view('template/_header', [
    'hasAd' => true
]) ?>

    <!-- content -->
    <div class="container">
        <?php $this->load->view('student-profile/partials/_profile-summary') ?>

        <div class="row">
            <div class="col-md-4">
                <?php $this->load->view('student-profile/partials/_student-about-summary') ?>
            </div><!--/.col-md-4-->

            <div class="col-md-8">
                <?php $this->load->view('student-profile/partials/_profile-navigation') ?>

                <div class="friends-container">
                    <?php if(isset($friends) && $friends != null): ?>
                        <?php $this->load->view('partials/_friends-grid', [
                            'friends' => $friends
                        ]) ?>
                    <?php else: ?>
                    <?php endif; ?>
                </div><!--/.friends-container-->
            </div><!--/.col-md-8-->

        </div><!--/.row-->

    </div><!--/.container-->

<?php $this->load->view('template/_footer') ?>

	<?php $this->load->view('student-profile/partials/_js-common') ?>

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
                            $('.friends-container').append('<?=Html::morePostsLoader()?>');
                        },
                        success: function(data) {
                            if(data.error == false) {
                                $('.friends-container').append(data.grid);
                                nextPageUrl = data.nextPageUrl;
                            } else {
                                alertError(data.message);
                            }
                        }
                    }).always(function() {
                        $('.friends-container').find('.more-posts-loader').remove();
                        $('#main').on('scroll', nextResults);
                    });
                }
            }

            $('#main').on('scroll', nextResults);
        });
    </script>

<?php $this->load->view('template/_closing-body') ?>
