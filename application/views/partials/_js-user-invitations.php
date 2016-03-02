<script type="text/javascript">
    $(document).ready(function() {
        $('.profile-actions-container').on('click', '.add-friend', function(e) {
            var thisButton = $(this);
            var profileActionsContainer = $(this).parents('.profile-actions-container').first();
            var user_id = $(this).attr('data-user-id');
            var replacementButton = '';
            $.ajax({
                url: '<?=base_url('user-actions/add-friend')?>',
                type: 'POST',
                dataType: 'JSON',
                data: {user_id:user_id},
                beforeSend: function() {
                    replacementButton = '<?=Html::cancelFriendRequestButton()?>';
                    replacementButton = replacementButton.replace(/:userId/g, user_id)
                    profileActionsContainer.html(replacementButton);
                },
                success: function(data) {
                    if(data.error) {
                        replacementButton = '<?=Html::addAsFriendButton()?>';
                        replacementButton = replacementButton.replace(/:userId/g, user_id)
                        profileActionsContainer.html(replacementButton);
                        alertError(data.message);
                    }
                }
            });
        });

        $('.profile-actions-container').on('click', '.cancel-friend-request', function(e) {
            var thisButton = $(this);
            var profileActionsContainer = $(this).parents('.profile-actions-container').first();
            var user_id = $(this).attr('data-user-id');
            var replacementButton = '';
            $.ajax({
                url : '<?=base_url('user-actions/cancel-friend-request')?>',
                type: 'POST',
                dataType: 'JSON',
                data: {user_id:user_id},
                beforeSend: function() {
                    replacementButton = '<?=Html::addAsFriendButton()?>';
                    replacementButton = replacementButton.replace(/:userId/g, user_id)
                    profileActionsContainer.html(replacementButton);
                },
                success: function(data) {
                    if(data.error) {
                        replacementButton = '<?=Html::cancelFriendRequestButton()?>';
                        replacementButton = replacementButton.replace(/:userId/g, user_id)
                        profileActionsContainer.html(replacementButton);
                        alertError(data.message);
                    }
                }
            });
        });

        $('.profile-actions-container').on('click', '.accept-friend-request', function(e) {
            var thisButton = $(this);
            var profileActionsContainer = $(this).parents('.profile-actions-container').first();
            var user_id = $(this).attr('data-user-id');
            var replacementButton = '';
            $.ajax({
                url : '<?=base_url('user-actions/accept-friend-request')?>',
                type: 'POST',
                dataType: 'JSON',
                data: {user_id:user_id},
                beforeSend: function() {
                    replacementButton = '<?=Html::unfriendButton()?>';
                    replacementButton = replacementButton.replace(/:userId/g, user_id)
                    profileActionsContainer.html(replacementButton);
                },
                success: function(data) {
                    if(data.error) {
                        replacementButton = '<?=Html::acceptFriendRequestButton()?><?=Html::ignoreFriendRequestButton()?>';
                        replacementButton = replacementButton.replace(/:userId/g, user_id)
                        profileActionsContainer.html(replacementButton);
                        alertError(data.message);
                    } else {
                        location.reload();
                    }
                }
            });
        });

        $('.profile-actions-container').on('click', '.ignore-friend-request', function(e) {
            var thisButton = $(this);
            var profileActionsContainer = $(this).parents('.profile-actions-container').first();
            var user_id = $(this).attr('data-user-id');
            var replacementButton = '';
            $.ajax({
                url: '<?=base_url('user-actions/ignore-friend-request')?>',
                type: 'POST',
                dataType: 'JSON',
                data: {user_id:user_id},
                beforeSend: function() {
                    replacementButton = '<?=Html::addAsFriendButton()?>';
                    replacementButton = replacementButton.replace(/:userId/g, user_id)
                    profileActionsContainer.html(replacementButton);
                },
                success: function(data) {
                    if(data.error) {
                        replacementButton = '<?=Html::acceptFriendRequestButton()?><?=Html::ignoreFriendRequestButton()?>';
                        replacementButton = replacementButton.replace(/:userId/g, user_id)
                        profileActionsContainer.html(replacementButton);
                        alertError(data.message);
                    } else {
                        location.reload();
                    }
                }
            });
        });

        $('.profile-actions-container').on('click', '.unfriend', function(e) {
            var thisButton = $(this);
            var profileActionsContainer = $(this).parents('.profile-actions-container').first();
            var user_id = $(this).attr('data-user-id');
            var replacementButton = '';
            $.ajax({
                url: '<?=base_url('user-actions/unfriend')?>',
                type: 'POST',
                dataType: 'JSON',
                data: {user_id:user_id},
                beforeSend: function() {
                    replacementButton = '<?=Html::addAsFriendButton()?>';
                    replacementButton = replacementButton.replace(/:userId/g, user_id)
                    profileActionsContainer.html(replacementButton);
                },
                success: function(data) {
                    if(data.error) {
                        replacementButton = '<?=Html::unfriendButton()?>';
                        replacementButton = replacementButton.replace(/:userId/g, user_id)
                        profileActionsContainer.html(replacementButton);
                        alertError(data.message);
                    } else {
                        location.reload();
                    }
                }
            });
        });
    });
</script>
