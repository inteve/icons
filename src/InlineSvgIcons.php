<?php

	namespace Inteve\Icons;


	class InlineSvgIcons implements \Phig\HtmlIcons
	{
		/** @var string */
		private $directory;

		/** @var array<string, Icon> */
		private $icons = [];


		/**
		 * @param string $directory
		 */
		public function __construct($directory)
		{
			$this->directory = $directory;
		}


		public function get($icon)
		{
			if (!isset($this->icons[$icon])) {
				if (\Nette\Utils\Strings::webalize($icon, '_') !== $icon) {
					throw new SorryInvalidArgument('Invalid icon name: ' . $icon);
				}

				$content = \Nette\Utils\FileSystem::read($this->directory . '/' . $icon . '.svg');
				$this->icons[$icon] = new Icon($this->preprocessContent($content));
			}

			return $this->icons[$icon];
		}


		/**
		 * @param  string $content
		 * @return string
		 */
		private function preprocessContent($content)
		{
			$dom = new \DOMDocument('1.0', 'UTF-8');
			$dom->preserveWhiteSpace = FALSE;
			@$dom->loadXML($content);  # @ - triggers warning on empty XML

			if (!isset($dom->documentElement)) {
				throw new SorryInvalidState('Invalid DOM.');
			}

			if (strtolower($dom->documentElement->nodeName) !== 'svg') {
				throw new SorryInvalidState("Sorry, only <svg> (non-prefixed) root element is supported but <{$dom->documentElement->nodeName}> is used. You may open feature request.");
			}

			$dom->documentElement->removeAttribute('id');
			$dom->documentElement->removeAttribute('style');

			$res = $dom->saveXML($dom->documentElement);

			if (!is_string($res)) {
				throw new SorryInvalidState('Missing DOM content.');
			}

			return $res;
		}
	}
