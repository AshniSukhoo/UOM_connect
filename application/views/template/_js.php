<!-- script references -->
<script src="/js/vendor/jquery.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/main.js" type="text/javascript"></script>
<script src="/js/plugins/sweet-alert/sweetalert.min.js" type="text/javascript"></script>
<?php if(isset($js_plugins) && !empty($js_plugins)): ?>
	<?=collect($js_plugins)->reduce(function($results, $item) { return $results.'<script src="'.$item.'" type="text/javascript"></script>'.PHP_EOL; }, '');?>
<?php endif; ?>
<script type="text/javascript">
	function alertError(message) {
		swal({
			title: "Oops!!...",
			type: "error",
			text: message,
			timer: 4000,
			showConfirmButton: false
		});
	}
</script>
