<script type="text/javascript">
	var nextPageUrl = '<?=$nextPageUrl?>';
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".post-status-area").autogrow();

		$(".comment-box").autogrow();

		$(".posts-container").on('click', '.like-action', function(e) {
			e.preventDefault();
			var likeButton = $(this);
			var post = likeButton.parents('.panel').first();
			$.ajax({
				url: '<?=base_url()?>posts/like',
				dataType: 'JSON',
				type: 'POST',
				data: {post_id:likeButton.attr('data-post-id')},
				beforeSend: function() {
					likeButton.removeClass('like-action');
					likeButton.addClass('active');
					likeButton.addClass('unlike-action');
					likeButton.blur();
				},
				success: function(data) {
					if(data.error == false) {
						post.find('.likes-container').find('.col-md-12').html(data.postLikes);
					} else {
						likeButton.removeClass('active');
						likeButton.removeClass('unlike-action');
						likeButton.addClass('like-action');
						alertError(data.message);
					}
				}
			});
		});

		$(".posts-container").on('click', '.unlike-action', function(e) {
			e.preventDefault();
			var unlikeButton = $(this);
			var post = unlikeButton.parents('.panel').first();
			$.ajax({
				url: '<?=base_url()?>posts/unlike',
				dataType: 'JSON',
				type: 'POST',
				data: {post_id:unlikeButton.attr('data-post-id')},
				beforeSend: function() {
					unlikeButton.removeClass('active');
					unlikeButton.removeClass('unlike-action');
					unlikeButton.addClass('like-action');
					unlikeButton.blur();
				},
				success: function(data) {
					if(data.error == false) {
						post.find('.likes-container').find('.col-md-12').html(data.postLikes);
					} else {
						unlikeButton.addClass('active');
						unlikeButton.addClass('unlike-action');
						unlikeButton.removeClass('like-action');
						alertError(data.message);
					}
				}
			});
		});

		$(".posts-container").on('click', '.like-comment', function(e) {
			e.preventDefault();
			var likeButton = $(this);
			var commentRow = likeButton.parents('.row').first();
			$.ajax({
				url: '<?=base_url()?>comments/like',
				dataType: 'JSON',
				type: 'POST',
				data: {comment_id:likeButton.attr('data-comment-id')},
				beforeSend: function() {
					likeButton.removeClass('like-comment');
					likeButton.addClass('unlike-comment');
					likeButton.html('Unlike');
					likeButton.blur();
				},
				success: function(data) {
					if(data.error == false) {
						commentRow.find('.comment-likes').html(data.commentLikes);
					} else {
						likeButton.addClass('like-comment');
						likeButton.removeClass('unlike-comment');
						likeButton.html('Like');
						alertError(data.message);
					}
				}
			});
		});

		$(".posts-container").on('click', '.unlike-comment', function(e) {
			e.preventDefault();
			var unlikeButton = $(this);
			var commentRow = unlikeButton.parents('.row').first();
			$.ajax({
				url: '<?=base_url()?>comments/unlike',
				dataType: 'JSON',
				type: 'POST',
				data: {comment_id:unlikeButton.attr('data-comment-id')},
				beforeSend: function() {
					unlikeButton.removeClass('unlike-comment');
					unlikeButton.addClass('like-comment');
					unlikeButton.html('Like');
					unlikeButton.blur();
				},
				success: function(data) {
					if(data.error == false) {
						commentRow.find('.comment-likes').html(data.commentLikes);
					} else {
						unlikeButton.removeClass('unlike-comment');
						unlikeButton.addClass('like-comment');
						unlikeButton.html('Like');
						unlikeButton.blur();
						alertError(data.message);
					}
				}
			});
		});

		$('.posts-container').on('click', '.more-comments', function(e) {
			e.preventDefault();
			var loader = '<?=Html::moreCommentsLoader()?>';
			var more_comments = $(e.target);
			var comments_container = more_comments.parents('.panel-footer').first().find('.comments-container');
			var prevMoreCommentsButton = more_comments.parents('.row').first();
			$.ajax({
				url: more_comments.attr('href'),
				type: 'GET',
				dataType: 'JSON',
				beforeSend: function() {
					more_comments.parents('.row').first().remove();
					comments_container.prepend(loader);
				},
				success: function(data) {
					if(data.error == false) {
						comments_container.prepend(data.comments);
					} else {
						comments_container.prepend(prevMoreCommentsButton);
						alertError(data.message);
					}
				}
			}).always(function() {
				comments_container.find('.more-comments-loader').remove();
			});
		});

		$('.posts-container').on('keypress','.comment-box', function(e) {
			if(e.keyCode == 13 && e.shiftKey){

			} else if(e.keyCode == 13) {
				e.preventDefault();
				e.stopPropagation();
				var $form = $(this).parents('.comment-on-post').first();
				$form.submit();
			}
		});

		$(".posts-container").on('submit', '.comment-on-post', function(e) {
			e.preventDefault();
			var form = $(this);
			var comment = form.find('.comment-box').val();
			var commentsContainer = form.parents('.panel-footer').first().find('.comments-container')
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				dataType: 'JSON',
				data: $(this).serialize(),
				beforeSend: function() {
					form[0].reset();
					form.find('.comment-box').css('height', '34px');
					form.find('.comment-box').blur();
				},
				success: function(data) {
					if(data.error == false) {
						commentsContainer.append(data.commentRow);
					} else {
						form.find('.comment-box').val(comment);
						form.find('.comment-box').focus();
						form.find('.comment-box').trigger('keyup');
						alertError(data.message);
					}
				}
			});
		});

		$('.post-status-form').on('submit', function(e) {
			e.preventDefault();
			var form = $(this);
			var post = form.find('.post-status-area').val();
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				dataType: 'JSON',
				data: $(this).serialize(),
				beforeSend: function() {
					form[0].reset();
					form.find('.post-status-area').css('height', '70px');
					form.find('.post-status-area').blur();
				},
				success: function(data) {
					if(data.error == false) {
                        if($('#no-feeds-text').length > 0) {
                            $('#no-feeds-text').remove();
                        }
						$('.posts-container').prepend(data.post);
					} else {
						form.find('.post-status-area').val(post);
						form.find('.post-status-area').focus();
						form.find('.post-status-area').trigger('keyup');
						alertError(data.message);
					}
				}
			});
		});

		function nextResults() {
			if(($('#main').scrollTop() + $('#main').innerHeight() >= $('#main')[0].scrollHeight) && (nextPageUrl != null && nextPageUrl != '')) {
				$.ajax({
					url: nextPageUrl,
					type: 'GET',
					dataType: 'JSON',
					beforeSend: function() {
						$('#main').off('scroll', nextResults);
						$('.posts-container').append('<?=Html::morePostsLoader()?>');
					},
					success: function(data) {
						if(data.error == false) {
							$('.posts-container').append(data.grid);
							nextPageUrl = data.nextPageUrl;
						} else {
							alertError(data.message);
						}
					}
				}).always(function() {
					$('.posts-container').find('.more-posts-loader').remove();
					$('#main').on('scroll', nextResults);
				});
			}
		}
		$('#main').on('scroll', nextResults);
	});
</script>
