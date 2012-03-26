<? if(isset($css)): ?>
	<? if(is_array($css)): ?>
		<? foreach($css as $value): ?>
			<link rel="stylesheet" type="text/css" href="<?=site_url('source/css/' . $value) ?>" />
		<? endforeach; ?>
	<? else: ?>
	<link rel="stylesheet" type="text/css" href="<?=site_url('source/css/' . $css) ?>" />
	<? endif ?>
<? endif ?>