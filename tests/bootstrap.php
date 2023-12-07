<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();


function test(string $description, Closure $closure): void
{
	$closure();
}


/**
 * @return string
 */
function prepareTempDir()
{
	static $dirs = [];

	@mkdir(__DIR__ . '/temp/');  # @ - directory may already exist

	$tempDir = __DIR__ . '/temp/' . getmypid();

	if (!isset($dirs[$tempDir])) {
		Tester\Helpers::purge($tempDir);
		$dirs[$tempDir] = TRUE;
	}

	return $tempDir;
}

