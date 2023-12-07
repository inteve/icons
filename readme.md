# Inteve\Icons

[![Build Status](https://github.com/inteve/icons/workflows/Build/badge.svg)](https://github.com/inteve/icons/actions)
[![Downloads this Month](https://img.shields.io/packagist/dm/inteve/icons.svg)](https://packagist.org/packages/inteve/icons)
[![Latest Stable Version](https://poser.pugx.org/inteve/icons/v/stable)](https://github.com/inteve/icons/releases)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/inteve/icons/blob/master/license.md)

Icons loader for web-apps.

<a href="https://www.janpecha.cz/donate/"><img src="https://buymecoffee.intm.org/img/donate-banner.v1.svg" alt="Donate" height="100"></a>


## Installation

[Download a latest package](https://github.com/inteve/icons/releases) or use [Composer](http://getcomposer.org/):

```
composer require inteve/icons
```

Inteve\Icons requires PHP 7.4.0 or later.


## Usage

This library is implementation of [PHIG's](https://github.com/phig-org/phig) `HtmlIcons` interface.


### InlineSvgIcons

``` php
$icons = new \Inteve\Icons\InlineSvgIcons($iconsDirectory);
echo $icons->get('my-icon'); // finds file "$iconsDirectory/my-icon.svg", prints <svg ...>...</svg>
```


### ImgIcons

``` php
$icons = new \Inteve\Icons\ImgIcons($publicUrlPath, $fileExtension, $htmlClass = 'icon');
echo $icons->get('my-icon'); // prints <img src="/path/to/my-icon.ext" class="icon" alt="">
echo $icons->get('my-icon@small'); // prints <img src="/path/to/my-icon.ext" class="icon icon--small" alt="">
```


### InlineStyleIcons

``` php
$icons = new \Inteve\Icons\InlineStyleIcons($publicUrlPath, $fileExtension, $htmlClass = 'icon', $tagName = 'i');
echo $icons->get('my-icon'); // prints <i class="icon" style="background-image:url(/path/to/my-icon.ext)"></i>
echo $icons->get('my-icon@small'); // prints <i class="icon icon--small" style="background-image:url(/path/to/my-icon.ext)"></i>
```


### WrappedIcons

``` php
$svgIcons = new \Inteve\Icons\InlineSvgIcons($iconsDirectory);
$icons = new \Inteve\Icons\WrappedIcons($svgIcons, $className = 'icon', $tagName = 'i');
echo $icons->get('my-icon'); // prints <i class="icon"><svg ...>...</svg></i>
echo $icons->get('my-icon@small'); // prints <i class="icon icon-small"><svg ...>...</svg></i>
```


### PrefixedIcons

``` php
$icons = new \Inteve\Icons\PrefixedIcons(
	icons: [
		'legacy' => new ImgIcons($publicUrlPath, $fileExtension),
		'bootstrap' => new \Inteve\Icons\InlineSvgIcons($bootstrapIconsDirectory),
	],
	defaultIcons: new \Inteve\Icons\InlineSvgIcons($iconsDirectory)
);
echo $icons->get('my-icon'); // prints <svg ...>...</svg>
echo $icons->get('legacy/my-icon'); // prints <img src="/path/to/my-icon.ext" class="icon" alt="">
echo $icons->get('bootstrap/my-icon'); // prints <svg ...>...</svg>
```

------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
