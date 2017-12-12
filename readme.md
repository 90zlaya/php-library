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
* All modules are inside /modules folder and contain subfolders for every module.
* All third-party classes are inside /classes/third-party folder and contain subfolders.

Every class call should have phplibrary namespace call in front.

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

* Temperature

Working with temperature conversions.

* User

Works with user related data.

* User_Agent

Working with user agent related data.

* Validation

Validation methods.

* Web_Service

Web service related data.

* Website

Use this class when working with website related data.
Instantiate it only once (great solution is Singleton design pattern) and call public parameters and methods across entire website.

List of modules
----------------

* file-version

This script looks up for files inside given path for those which are changed since certain point in time.
If or when it finds them, then creates two files, or updates them, with informations about date, version and changed files.

* image-sorter

Crawls for files in one folder, creates new folders according to files prefix and copies them to that newly created folder.

* spider 

This script crawls for visitor's data. It's possible to display them, write to database and send via email.

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

Acknowledgements
----------------

Copyright © 2017 | [Zlatan Stajic] | Released under the [MIT License]

[Zlatan Stajic]: https://www.zlatanstajic.com/
[GitHub]: https://github.com/90zlaya/php-library
[Packagist]: https://packagist.org/packages/90zlaya/php-library
[MIT License]: http://www.opensource.org/licenses/mit-license.php
[latest release]: https://github.com/90zlaya/php-library/releases/latest