<?php

use Inteve\Icons;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

define('TEMP_DIR', prepareTempDir());
file_put_contents(TEMP_DIR . '/super_icon.svg', '<?xml version = "1.0" encoding = "UTF-8" standalone = "no" ?>
<svg version="1.1" width="200" height="200" viewBox="-100 -100 200 200" xmlns="http://www.w3.org/2000/svg" id="super_icon" style="width:10px">
	<circle cx="0" cy="20" r="70" fill="#D1495B" />
</svg>');

test('default', function () {
	$defaultIcons = new Icons\InlineStyleIcons(
		'/public',
		'png'
	);
	$icons = new Icons\PrefixedIcons([
		'svg' => new Icons\InlineSvgIcons(TEMP_DIR),
		'img' => new Icons\ImgIcons('/public/img', 'png'),
		'wrapped' => new Icons\WrappedIcons($defaultIcons, 'iconWrapper', 'span'),
	], $defaultIcons);

	Assert::same('<i class="icon" style="background-image:url(/public/first.png)"></i>', (string) $icons->get('first'));
	Assert::same('<i class="icon icon--small" style="background-image:url(/public/first.png)"></i>', (string) $icons->get('first@small'));

	Assert::same('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="200" height="200" viewBox="-100 -100 200 200"><circle cx="0" cy="20" r="70" fill="#D1495B"/></svg>', (string) $icons->get('svg/super_icon'));

	Assert::same('<img class="icon" src="/public/img/second.png" alt="">', (string) $icons->get('img/second'));
	Assert::same('<img class="icon icon--small" src="/public/img/second.png" alt="">', (string) $icons->get('img/second@small'));

	Assert::same('<span class="iconWrapper"><i class="icon" style="background-image:url(/public/test.png)"></i></span>', (string) $icons->get('wrapped/test'));
	Assert::same('<span class="iconWrapper iconWrapper--small"><i class="icon" style="background-image:url(/public/test.png)"></i></span>', (string) $icons->get('wrapped/test@small'));
});
