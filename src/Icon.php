<?php

	namespace Inteve\Icons;


	class Icon implements \Phig\HtmlString, \Nette\Utils\IHtmlString
	{
		/** @var string */
		private $html;


		/**
		 * @param string $html
		 */
		public function __construct($html)
		{
			$this->html = $html;
		}


		public function __toString()
		{
			return $this->html;
		}
	}
