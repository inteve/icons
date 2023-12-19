<?php

	declare(strict_types=1);

	namespace Inteve\Icons;

	use Nette\Utils\Strings;


	/**
	 * Generates <img> icons
	 */
	class ImgIcons implements \Phig\HtmlIcons
	{
		/** @var string */
		private $publicPath;

		/** @var string */
		private $fileExtension;

		/** @var string|NULL */
		private $className;


		/**
		 * @param string $publicPath
		 * @param string $fileExtension
		 * @param string|NULL $className
		 */
		public function __construct(
			$publicPath,
			$fileExtension,
			$className = 'icon'
		)
		{
			$this->publicPath = $publicPath;
			$this->fileExtension = $fileExtension;
			$this->className = $className;
		}


		public function get($icon)
		{
			$className = $this->className;
			$parts = explode('@', $icon, 2);

			// parsing icon name & size modifier icon@sm
			if (count($parts) === 2) {
				$icon = $parts[0];

				if ($className !== NULL) {
					$className = $className . ' ' . $className . '--' . $parts[1];
				}
			}

			if (!\Nette\Utils\Validators::is($icon, 'pattern:[a-z]([a-z0-9_-]*[a-z])?')) {
				throw new SorryInvalidArgument('Invalid icon name: ' . $icon);
			}

			$iconHtml = \Nette\Utils\Html::el('img');

			if ($className !== NULL) {
				$iconHtml->class($className);
			}

			$iconHtml->src($this->publicPath . '/' . $icon . '.' . $this->fileExtension)
				->alt('');

			return new Icon((string) $iconHtml);
		}
	}
