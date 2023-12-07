<?php

	namespace Inteve\Icons;


	/**
	 * Wraps icon into HTML tag.
	 */
	class WrappedIcons implements \Phig\HtmlIcons
	{
		/** @var \Phig\HtmlIcons */
		private $icons;

		/** @var string */
		private $className;

		/** @var string */
		private $tagName;


		/**
		 * @param string $className
		 * @param string $tagName
		 */
		public function __construct(
			\Phig\HtmlIcons $icons,
			$className = 'icon',
			$tagName = 'i'
		)
		{
			$this->icons = $icons;
			$this->className = $className;
			$this->tagName = $tagName;
		}


		public function get($icon)
		{
			$className = $this->className;
			$parts = explode('@', $icon, 2);

			// parsing icon name & size modifier icon@sm
			if (count($parts) === 2) {
				$icon = $parts[0];
				$className = $className . ' ' . $className . '--' . $parts[1];
			}

			$iconHtml = \Nette\Utils\Html::el($this->tagName)
				->class($className)
				->setHtml($this->icons->get($icon));

			return new Icon((string) $iconHtml);
		}
	}
