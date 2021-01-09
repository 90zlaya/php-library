[![PHP Library Logo](https://php-library.zlatanstajic.com/assets/img/phplibrary-logo-blue.png?clear_cache=3)](https://php-library.zlatanstajic.com)

# Description

PHP Library is a set of classes that contain the most useful attributes and methods that facilitate the development of Web applications.
Project is open-sourced under MIT licence on [GitHub](https://github.com/90zlaya/php-library). Available over Composer and [Packagist].

[![Latest Stable Version]][latest release]
[![Total Downloads]][Packagist]
[![Travis Build Status]][Travis-CI]
[![Coverage Status]][Coverals]

# Organization

## Files and Folders

* All source files are inside [src](src/) folder.
* All unit tests are inside [tests](tests/) folder.

## PHP Library League

[PHP Library League](https://github.com/php-library-league) represents group of developers making everything about PHP Library to be even richer. Since main goal for this library is to stay as lightweight as possible, some of the functionalities for development and testing are created as separate projects.

* [Demo](https://github.com/php-library-league/demo): PHP Library demonstrations scripts
* [Shell](https://github.com/php-library-league/shell): PHP Library shell scripts
* [Outsource](https://github.com/php-library-league/outsource): PHP Library outsource folder
* [Assets](https://github.com/php-library-league/assets): PHP Library official website assets
* [Logos](https://github.com/php-library-league/logos): PHP Library and PHP Library League logos

Every single one of these projects has detailed instructions on how to integrate them inside PHP Library. Pay close attention to match release version of PHP Library with release version of desired project.

# Installation

There are two ways of using PHP Library. First one is to install it inside another project, let's say framework like [CodeIgniter](https://www.codeigniter.com) or [Laravel](https://laravel.com). Second one is to install it for development. Here's detailed list of PHP versions supported.

PHP  | Production | Development
---- | ---------- | -----------
7.0  | Yes        | No
7.1  | Yes        | No
7.2  | Yes        | No
7.3  | Yes        | Yes
7.4  | Yes        | Yes

*Production* column shows on which versions PHP Library will work. \
*Development* column shows on which versions PHP Library will work for development.

## Manual

If you want the stable version, get the [latest release] from the releases page.

## Composer

Install stable library version by using standard commands.

```bash
# Install PHP Library via Composer
composer require 90zlaya/php-library
```

## GitHub

If you want to develop this library and use GitHub instead of manual download, just clone repository to your machine.

```bash
# Clone repository via Git
git clone https://github.com/90zlaya/php-library.git
```

# Development

## Coding Standard

PHP Library has it's own coding standard inspired by CodeIgniter. To contribute to development of this project, you must follow this standard. [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) checks those rules for you in development versions of PHP Library.

```bash
# Run coding standard check
composer run phpcs
```

If you want to find out more about specific rules, open [phpcs.xml](phpcs.xml) file.

## Static Analysis

PHP Library has been tested with [PHP Stan](https://github.com/phpstan/phpstan) and approved as bug-free. It's recommended to run following command to check for bugs in project.

```bash
# Run static analysis
composer run phpstan
```

If you want to find out more about specific rules, open [phpstan.neon](phpstan.neon) file.

## Unit Testing

PHP Library is covered with [PHPUnit](https://github.com/sebastianbergmann/phpunit) tests. They require [outsource folder](https://github.com/php-library-league/outsource) to perform specific tests. 

```bash
# Run PHPUnit tests
composer run phpunit
```

If you want to find out more about specific rules, open [phpunit.xml](phpunit.xml) file.

# References

## Inspiration

Idea behind creation of this repository is making everyday Web Development process faster and easier.

## Logo

Official PHP Library logo is designed by [designseed.co](https://designseedco.com/en) - an unlimited custom graphic design service.

## API Documentation

Official PHP Library API documentation has been documented by [phpDocumentor](https://www.phpdoc.org) and could be studied online on [api](https://php-library.zlatanstajic.com/api) website.

## Code Coverage

Official PHP Library code coverage report has been composed by [xDebug](https://xdebug.org) and could be studied online on [coverage](https://php-library.zlatanstajic.com/coverage) website.

[Packagist]: https://packagist.org/packages/90zlaya/php-library
[Travis-CI]: https://travis-ci.com/90zlaya/php-library
[latest release]: https://github.com/90zlaya/php-library/releases/latest
[Coverals]:https://coveralls.io/github/90zlaya/php-library
[Latest Stable Version]: https://poser.pugx.org/90zlaya/php-library/v/stable?clear_cache=3
[Total Downloads]: https://poser.pugx.org/90zlaya/php-library/downloads?clear_cache=3
[Travis Build Status]: https://img.shields.io/travis/90zlaya/php-library.svg?clear_cache=3
[Coverage Status]: https://coveralls.io/repos/github/90zlaya/php-library/badge.svg?branch=master&clear_cache=3
