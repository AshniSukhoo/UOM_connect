<script type="text/javascript">
	var nextPageUrl = '<?=$nextPageUrl?>';
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".post-status-area").autoGrow();

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

		function nextResults() {
			if(($('#main').scrollTop() + $('#main').innerHeight() >= $('#main')[0].scrollHeight) && (nextPageUrl != null)) {
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