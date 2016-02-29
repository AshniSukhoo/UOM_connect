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

                <?php if(isset($friends) && $friends != null): ?>
                    <?php $this->load->view('partials/_friends-grid', [
                        'friends' => $friends
                    ]) ?>
                <?php else: ?>
                <?php endif; ?>
            </div><!--/.col-md-8-->

        </div><!--/.row-->

    </div><!--/.container-->

<?php $this->load->view('template/_footer') ?>

	<?php $this->load->view('student-profile/partials/_js-common') ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

        });
    </script>

<?php $this->load->view('template/_closing-body') ?>
