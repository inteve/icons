<?php

declare(strict_types=1);

use Inteve\Icons;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('default', function () {
	$icons = new Icons\InlineStyleIcons(
		'/public',
		'png'
	);

	Assert::same('<i class="icon" style="background-image:url(/public/first.png)"></i>', (string) $icons->get('first'));
	Assert::same('<i class="icon icon--small" style="background-image:url(/public/first.png)"></i>', (string) $icons->get('first@small'));
});


test('No className', function () {
	$icons = new Icons\InlineStyleIcons(
		'/public',
		'png',
		NULL
	);

	Assert::same('<i style="background-image:url(/public/first.png)"></i>', (string) $icons->get('first'));
	Assert::same('<i style="background-image:url(/public/first.png)"></i>', (string) $icons->get('first@small'));
});


test('File extension', function () {
	$icons = new Icons\InlineStyleIcons(
		'/public',
		'png'
	);

	Assert::same('<i class="icon" style="background-image:url(/public/first.gif)"></i>', (string) $icons->get('first.gif'));
});
