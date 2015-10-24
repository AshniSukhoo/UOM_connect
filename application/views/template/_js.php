<!-- script references -->
<script src="/js/vendor/jquery.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/main.js" type="text/javascript"></script>
<?php if(isset($js_plugins) && !empty($js_plugins)): ?>
    <?php foreach($js_plugins as $js_plugin): ?>
        <script src="<?=$js_plugin?>" type="text/javascript"></script>
    <?php endforeach; ?>
<?php endif; ?>
