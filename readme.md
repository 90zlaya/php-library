[![License](https://poser.pugx.org/phpstan/phpstan/license)](https://opensource.org/licenses/MIT)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

PHP Library
=======

PHP Library is set of custom made PHP classes containing most useful methods and variables for Web Development.
Project is open-sourced under MIT licence on [GitHub]. Available over Composer and [Packagist].

Organisation
=======

Autoload file is inside root directory. It contains calls to every class inside php-library.

``` php
include_once 'autoload.php';
```

* All classes are inside /classes folder.
* All class demonstrations are inside /demonstrations folder.
* All third-party classes are inside /third-party folder including Composer vendors.

Every native class call should have phplibrary\ namespace call in front.

``` php
phplibrary\Class_Name
```

List of classes
----------------

* Date_Time_Format

Date and Time formating, validating, comparing, converting...

* Directory_Lister

Directory content retrieval.

* Email

Email-related operations.

* Export

Export files using customisation class of PHPOffice/PHPExcel. Location: https://github.com/PHPOffice/PHPExcel Don't forget to call composer update in root folder for latest PHPOffice/PHPExcel library. Otherwise it will throw an error after trying to interpret require_once on Composer's autoload file.

* File

File-related operations.

* File_Version

Checking for changed files and creating file version numbers.

* Format

Format related methods.

* Geo_Plugin

Customisation of third-party class geoPlugin. Location: http://www.geoplugin.com/

* Math

Mathematical operations and calculations.

* Operating_System

Working with Operating System related data.

* Password

Works with password related data.

* Random

Random-related data.

* Sorter

Sortes files to multiple folders.

* Temperature

Working with temperature conversions.

* User_Agent

Working with user agent related data.

* User

Works with user related data.

* Validation

Validation methods.

* Web_Service

Web service related data.

* Website

Use this class when working with website related data.
Instantiate it only once (great solution is Singleton design pattern) and call public parameters and methods across entire website.

List of third-party
----------------

* geoplugin.class

This PHP class uses the PHP Webservice of http://www.geoplugin.com/ to geolocate IP addresses. Geographical location of the IP address (visitor) and locate currency (symbol, code and exchange rate) are returned.

* PHPOffice/PHPExcel

PHPExcel is a library written in pure PHP and providing a set of classes that allow you to write to and read from different spreadsheet file formats, like Excel (BIFF) .xls, Excel 2007 (OfficeOpenXML) .xlsx, CSV, Libre/OpenOffice Calc .ods, Gnumeric, PDF, HTML, ... This project is built around Microsoft's OpenXML standard and PHP.

Installation
=======

Manual
----------------
If you want the latest stable version, get the [latest release] from the releases page.

Composer
----------------

Install stable php-library version by using standard commands or if you wish to test latest development version of php-library, just add dev-master in extension.

```
composer require 90zlaya/php-library
```

Misc
=======

Inspiration
----------------

Idea behind creation of this repository is making everyday Web Development process faster and easier.

Customers
----------------

This library if powering following Websites/Web Applications:

* [www.zlatanstajic.com]

Bug analysis
----------------

This library has been tested with [PHP Stan] and approved as bug-free for all classes and demonstrations.

API documentation
----------------

Official PHP Library API has been documented by [phpDocumentor].

Acknowledgements
----------------

Copyright © 2017-2018 | [Zlatan Stajic] | Released under the [MIT License]

[Zlatan Stajic]: https://www.zlatanstajic.com/
[GitHub]: https://github.com/90zlaya/php-library
[Packagist]: https://packagist.org/packages/90zlaya/php-library
[MIT License]: http://www.opensource.org/licenses/mit-license.php
[latest release]: https://github.com/90zlaya/php-library/releases/latest
[www.zlatanstajic.com]: https://www.zlatanstajic.com/
[PHP Stan]: https://github.com/phpstan/phpstan
[phpDocumentor]: https://www.phpdoc.org/