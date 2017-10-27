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
* All demonstrations are inside /demonstrations folder.
* All modules are inside /modules folder and contain subfolders for every module.

Every class call should have phplibrary namespace call in front.

``` php
phplibrary\Class_Name
``` 

List of classes
----------------

* Breadcrumbs
* Browser
* Date_Time_Format
* Directory_Lister
* Email
* File
* Format
* Operating_System
* Pagination
* Password
* Random
* Temperature
* User
* Validation
* Web_Service
* Website

List of modules
----------------

* file-version

Composer
=======

Install stable php-library version by using standard commands or if you wish to test latest development version of php-library, just add ":dev-master" in extension.

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

Copyright © 2017 | [Zlatan Stajic] | Released under the [MIT License].

[Zlatan Stajic]: https://www.zlatanstajic.com/
[GitHub]: https://github.com/90zlaya/php-library
[Packagist]: https://packagist.org/packages/90zlaya/php-library
[MIT License]: http://www.opensource.org/licenses/mit-license.php