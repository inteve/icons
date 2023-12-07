<?php

	declare(strict_types=1);

	namespace Inteve\Icons;

	use Nette\Utils\Strings;


	class PrefixedIcons implements \Phig\HtmlIcons
	{
		/** @var array<string, \Phig\HtmlIcons> */
		private $icons;

		/** @var \Phig\HtmlIcons */
		private $defaultIcons;


		/**
		 * @param array<string, \Phig\HtmlIcons> $icons
		 */
		public function __construct(
			array $icons,
			\Phig\HtmlIcons $defaultIcons
		)
		{
			$this->icons = $icons;
			$this->defaultIcons = $defaultIcons;
		}


		public function get($icon)
		{
			$prefix = Strings::before($icon, '/');

			if (is_string($prefix) && isset($this->icons[$prefix])) {
				return $this->icons[$prefix]->get((string) Strings::after($icon, '/'));
			}

			return $this->defaultIcons->get($icon);
		}
	}
