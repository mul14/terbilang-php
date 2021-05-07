# Terbilang

[![Build Status](https://travis-ci.org/mul14/terbilang-php.svg?branch=master)](https://travis-ci.org/mul14/terbilang-php)
[![Latest Stable Version](https://poser.pugx.org/nasution/terbilang/v/stable.svg)](https://packagist.org/packages/nasution/terbilang)
[![Total Downloads](https://poser.pugx.org/nasution/terbilang/downloads.svg)](https://packagist.org/packages/nasution/terbilang)
[![Latest Unstable Version](https://poser.pugx.org/nasution/terbilang/v/unstable.svg)](https://packagist.org/packages/nasution/terbilang)
[![License](https://poser.pugx.org/nasution/terbilang/license.svg)](https://github.com/mul14/terbilang-php/blob/master/LICENSE)

Convert numbers into words (and vice-versa) in Indonesian language.

## Installation

Run [composer](http://getcomposer.org) command

```bash
composer require nasution/terbilang
```

## Usage

Using the  `terbilang()` and `tersebut()` helper:

```php
<?php

require 'vendor/autoload.php';

echo terbilang(421); // empat ratus dua puluh satu (string)
echo tersebut('empat ratus dua puluh satu'); // 421.0 (float)
```

Old examples:

```php
<?php

require 'vendor/autoload.php';

echo \Nasution\Terbilang::convert(42); // empat puluh dua
echo \Nasution\Terbilang::revert('empat puluh dua');  // 42.0 (float)
```

You can also import the class to make it more convenient to use:
```php
<?php

require 'vendor/autoload.php';

use Nasution\Terbilang;

echo Terbilang::convert('123304'); // seratus dua puluh tiga ribu tiga ratus empat
echo Terbilang::revert('seratus dua puluh tiga ribu tiga ratus empat'); // 123304.0 (float)
```

Another examples:

```php
echo Terbilang::convert('1000000');          // satu juta
echo Terbilang::convert('1000000000');       // satu milyar
echo Terbilang::convert('1000000000000');    // satu triliun
echo Terbilang::convert('1000000000000000'); // satu kuadriliun


echo Terbilang::revert('satu juta');       // 1000000
echo Terbilang::revert('satu milyar');     // 1000000000
echo Terbilang::revert('satu triliun');    // 1000000000000
echo Terbilang::revert('satu kuadriliun'); // 1000000000000000
echo Terbilang::revert('seratus milyar tiga puluh juta dua puluh ribu sepuluh'); // 100030020010.0
```

You can also use dot notation on `Terbilang::convert()` to separate the numbers:

```php
echo Terbilang::convert('1.300.000');       // satu juta tiga ratus ribu
echo Terbilang::convert('100.030.020.010'); // seratus milyar tiga puluh juta dua puluh ribu sepuluh
```
