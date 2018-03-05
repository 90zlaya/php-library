![PHP Version](https://img.shields.io/badge/php-%3E%3D7.1-blue.svg)
![Composer](https://img.shields.io/badge/composer-required-yellow.svg)
![Travis](https://img.shields.io/travis/90zlaya/php-library.svg)

![Official logo of php-library](https://php-library.zlatanstajic.com/assets/img/phplibrary-logo-blue.png?clear_cache=1)
=======

PHP Library is set of custom made PHP classes containing most useful methods and variables for Web Development.
Project is open-sourced under MIT licence on [GitHub]. Available over Composer and [Packagist].

Organisation
=======

Every native class call should have phplibrary namespace call in front.

``` php
phplibrary\Class_Name
```

* All classes are inside src folder.
* All unit tests are inside tests folder.

Autoload file is created by Composer and it's located inside vendor folder.

``` php
include_once 'vendor/autoload.php';
```

Installation
=======

There are two ways of using PHP Library. First one is to install it inside another project, let's say framework like CodeIgniter. Second one is to install it for development. Either way, you need PHP 7 and Composer to do it.

Manual
----------------

If you want the stable version, get the [latest release] from the releases page.

Composer
----------------

Install stable library version by using standard commands.

```
$ composer require 90zlaya/php-library
```

GitHub
----------------

If you want to develop this library and use GitHub instead of manual download, just clone repository to your hard drive.

```
$ git clone https://github.com/90zlaya/php-library.git
```

Development
=======

Coding standard
----------------

PHP Library has it's own coding standard which deviates from PSR-2 standard with no much exceptions. To contribute to development of this project, you must follow this standard. [PHP_CodeSniffer] does this job for you in development versions of PHP Library.

```
$ vendor/bin/phpcs index.php --standard='ruleset.xml'
```

If you want to find out more about specific rules, open ruleset.xml file which is located in root directory.

Bug analysis
----------------

This library has been tested with [PHP Stan] and approved as bug-free for all classes. It's recommended to run following command to check for buggs in project.

```
$ vendor/bin/phpstan analyse src --level max
```

Unit testing
---------------

All tests are covered with PHPUnit framework and stored inside tests folder. They need outsource folder to perform specific tests, which you have to clone from GitHub to PHP Library's root directory.

```
$ git clone https://github.com/php-library-league/outsource.git
```

Command for running unit tests will target phpunit.xml file which is located inside root directory.

```
$ vendor/bin/phpunit
```

Automatic tests
----------------

You can run all possible automatic tests at once with one simple command.

```
$ bash autotest
```

* Coding standard with PHP_CodeSniffer
* Bug analysis with PHPStan
* Running unit tests with PHPUnit

Precondition for running all tests above is having Composer vendors updated and outsource repository cloned from GitHub.

References
=======

Inspiration
----------------

Idea behind creation of this repository is making everyday Web Development process faster and easier.

Logo
----------------

Official PHP Library logo is designed by [designseed.co] - an unlimited custom graphic design service.

Customers
----------------

This library if powering following Websites/Web Applications:

* [zlatanstajic.com]

![Homepage of zlatanstajic.com](https://link.zlatanstajic.com/images/portfolio/small/zlatanstajic.jpg?clear_cache=1)

* [cms.dis.rs]

![Login page of cms.dis.rs](https://link.zlatanstajic.com/images/portfolio/small/cms.dis.jpg?clear_cache=1)

API documentation
----------------

Official PHP Library API documentation has been documented by [phpDocumentor] and could be studied [online].

Migration
----------------

When you update library version from older to newer, it's recommended to consult changelog file, which is located under the name log.txt in root directory.

Acknowledgements
----------------

Copyright © 2017-2018 | [Zlatan Stajic] | Released under the [MIT License]

[Zlatan Stajic]: https://www.zlatanstajic.com/
[GitHub]: https://github.com/90zlaya/php-library
[Packagist]: https://packagist.org/packages/90zlaya/php-library
[MIT License]: http://www.opensource.org/licenses/mit-license.php
[latest release]: https://github.com/90zlaya/php-library/releases/latest
[online]: https://php-library.zlatanstajic.com/api/
[zlatanstajic.com]: https://www.zlatanstajic.com/
[cms.dis.rs]: https://cms.dis.rs/
[PHP Stan]: https://github.com/phpstan/phpstan
[phpDocumentor]: https://www.phpdoc.org/
[PHP_CodeSniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[designseed.co]: https://designseedco.com/en/