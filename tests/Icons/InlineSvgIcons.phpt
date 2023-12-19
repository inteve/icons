<?php

declare(strict_types=1);

use Inteve\Icons;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

define('TEMP_DIR', prepareTempDir());

test('default', function () {
	file_put_contents(TEMP_DIR . '/super_icon-x.svg', '<?xml version = "1.0" encoding = "UTF-8" standalone = "no" ?>
<svg version="1.1" width="200" height="200" viewBox="-100 -100 200 200" xmlns="http://www.w3.org/2000/svg" id="super_icon" style="width:10px">
	<circle cx="0" cy="20" r="70" fill="#D1495B" />
</svg>');

	$icons = new Icons\InlineSvgIcons(TEMP_DIR);

	Assert::same('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="200" height="200" viewBox="-100 -100 200 200"><circle cx="0" cy="20" r="70" fill="#D1495B"/></svg>', (string) $icons->get('super_icon-x'));
});
