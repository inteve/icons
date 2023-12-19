<?php

declare(strict_types=1);

use Inteve\Icons;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('default', function () {
	$icons = new Icons\ImgIcons(
		'/public',
		'png'
	);

	Assert::same('<img class="icon" src="/public/first.png" alt="">', (string) $icons->get('first'));
	Assert::same('<img class="icon icon--modifier" src="/public/first.png" alt="">', (string) $icons->get('first@modifier'));
});


test('No className', function () {
	$icons = new Icons\ImgIcons(
		'/public',
		'png',
		NULL
	);

	Assert::same('<img src="/public/first.png" alt="">', (string) $icons->get('first'));
	Assert::same('<img src="/public/first.png" alt="">', (string) $icons->get('first@modifier'));
});
