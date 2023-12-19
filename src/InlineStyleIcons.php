<?php

	declare(strict_types=1);

	namespace Inteve\Icons;

	use Nette\Utils\Strings;


	/**
	 * Generates <i class="icon" style="background-image: url()"> icons
	 */
	class InlineStyleIcons implements \Phig\HtmlIcons
	{
		/** @var string */
		private $publicPath;

		/** @var string */
		private $fileExtension;

		/** @var string|NULL */
		private $className;

		/** @var string */
		private $tagName;

		/** @var array<string, \Phig\HtmlString> */
		private $icons = [];


		/**
		 * @param string $publicPath
		 * @param string $fileExtension
		 * @param string|NULL $className
		 * @param string $tagName
		 */
		public function __construct(
			$publicPath,
			$fileExtension,
			$className = 'icon',
			$tagName = 'i'
		)
		{
			$this->publicPath = $publicPath;
			$this->fileExtension = $fileExtension;
			$this->className = $className;
			$this->tagName = $tagName;
		}


		public function get($icon)
		{
			if (!isset($this->icons[$icon])) {
				$className = $this->className;
				$parts = explode('@', $icon, 2);

				if (count($parts) === 2) {
					$icon = $parts[0];

					if ($className !== NULL) {
						$className = $className . ' ' . $className . '--' . $parts[1];
					}
				}

				if (!\Nette\Utils\Validators::is($icon, 'pattern:[a-z]([a-z0-9_.-]*[a-z])?')) {
					throw new SorryInvalidArgument('Invalid icon name: ' . $icon);
				}

				if (!Strings::contains($icon, '.')) {
					$icon = $icon . '.' . $this->fileExtension;
				}

				$iconHtml = \Nette\Utils\Html::el($this->tagName);

				if ($className !== NULL) {
					$iconHtml->class($className);
				}

				$iconHtml->style('background-image', 'url(' . $this->publicPath . '/' . $icon . ')');

				$this->icons[$icon] = new Icon((string) $iconHtml);
			}

			return $this->icons[$icon];
		}
	}
