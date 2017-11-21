PHP Library
=======

PHP Library is set of custom made PHP classes containing most useful methods and variables for Web Development.
Project is open-sourced under MIT licence on [GitHub]. Available over Composer and [Packagist].

Organisation
=======

Autoload file is inside root directory. It contains calls to every class inside php-library. Don't forget to add "../" if you call autoloader from some of the folders. You won't need that call if you're working in root directory.

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

* Pagination

This is special class constructed from one of special templates accustomed to work everywhere. It's not by standard but it might help.

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

Composer
=======

Install stable php-library version by using standard commands or if you wish to test latest development version of php-library, just add ":dev-master" in extension.

```
composer require 90zlaya/php-library
```

Changelog
=======

Since php-library v1.1.1
----------------

Modification:

* Date_Time_Format: days_before method added.

Since php-library v1.1.0
----------------

Modification:

* Browser: class is now reformated to User_Agent
* Date_Time_Format: format_to_database and format_to_user now validating date and ensuring if date is not empty - new method not_empty created. Variables reformated to $types array.
* Directory_Lister: file size added to file method.
* Email: documentation of methods updated.
* Format: return values revisited, ip location method now uses geoPlugin free service instead of limited info-sniper, even_or_odd class removed because duplicate exists in Math class.
* Geo_Plugin: huge modification of array structure and methods, location and referer added, removed parent::__construct().
* Math: even_or_odd method modified, static keyword added to percentage method.
* User: removed ip and ua methods because they exist in Geo_Plugin class under array elements of data['base']['address'] and data['base']['agent'].
* Website: reformated if statements, location and referer added.

* third-party class geoPlugin: removed method of same name.

* Spider module now works with Geo_Plugin class instead of built-in geoPlugin and works over multiple functions and has MySql and MS SQL connections now. Updated after modifications of Geo_Plugin class.

New:

* third-party folder added with geoplugin.class.
* Geo_Plugin: customisation of third-party class geoPlugin.
* image-sorter module added.

Misc
=======

Inspiration
----------------

Idea behind creation of this repository is making everyday Web Development process faster and easier. 

Acknowledgements
----------------

Copyright © 2017 | [Zlatan Stajic] | Released under the [MIT License].

[Zlatan Stajic]: https://www.zlatanstajic.com/
[GitHub]: https://github.com/90zlaya/php-library
[Packagist]: https://packagist.org/packages/90zlaya/php-library
[MIT License]: http://www.opensource.org/licenses/mit-license.php