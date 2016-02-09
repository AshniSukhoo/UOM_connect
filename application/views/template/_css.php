<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet">
<link href="/css/styles.css" rel="stylesheet">
<link href='/css/hint.min.css' rel='stylesheet' type='text/css'>
<link href='/css/sweetalert.css' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<?php if(isset($css) && !empty($css)): ?>
	<?=collect($css)->reduce(function($result, $item) { return $result.'<link href="'.$item.'" rel="stylesheet" type="text/css">'.PHP_EOL; }, '');?>
<?php endif; ?>