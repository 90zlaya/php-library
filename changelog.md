Since php-library v1.5.1 (07-Dec-2018)
=======

Important
----------------

* File_Version: class removed from library
* Operating_System: class removed from library
* Sorter: multidimensional_array method moved to Format class
* Sorter: entire class refactored
* User: attributes and methods redefined and moved to File class
* Website: redirect_to_page method removed

New
----------------

* Dump: new class developed and tested
* Password: digest method added
* User_Agent: detect_operating_system method added

Since php-library v1.5.0 (6-Apr-2018)
=======

Modified
----------------

* Export: setting cell data type
* Random: break_caching method added
* Sorter: multidimensional_array method added
* Sorter: overwrite option added to deploy method

* Cosmetical edits to code
* phpunit.xml 7.2 validation fix
* Array arrow indentation fix for CodeSniffer v3.3
* composer.json vendor versions update

Since php-library v1.4.0 (10-Mar-2018)
=======

New
----------------

* Import: new class Import created

Modified
----------------

* Date_Time_Format: protected validate method removed
* Format: static keyword added for force_download method
* User: attributes $image_location and $image_default set as public

Since php-library v1.3.0 (06-Feb-2018)
=======

Important
----------------

* using composer autoloader instead of native one
* composer vendors are stored directly into root
* classes folder renamed to src
* demonstrations folder removed
* third-party folder removed
* Export: phpoffice/phpexcel replaced with phpoffice/phpspreadsheet
* Format: add_to_array method removed
* Password: strength method returns array instead of mixed value and not accepting second parameter anymore
* Validation: variables method removed from class

Modified
----------------

* Directory_Lister: created prepare_date method after refactoring check_date method
* Geo_Plugin: service is now built in instead of extending geoPlugin class

Since php-library v1.2.0 (06-Jan-2018)
=======

Important
----------------

* Password: new method is now called new_unreadable method
* Export: export method is now called export_file method

New
----------------

* File_Version: new class File_Version developed from file-version module
* File_Version: development of dump method broken to three private methods
* File_Version: added option to set file_names from dump method

Modified
----------------

* Date_Time_Format: number_to_day method created
* Date_Time_Format: days_after method created
* Directory_Lister: array of years can be passed to listing method
* Email: show method created
* Email: script method created
* Email: split method created
* Export: output buffering added for csv and osp export
* File: force_download method created
* Format: in_wizard method created
* Geo_Plugin: removed protected collect method
* User_Agent: list_crawlers method created
* User_Agent: is_crawler method created

Removed
----------------

* file-version: entire module removed and replaced with File_Version class

Since php-library v1.1.0 (02-Dec-2017)
=======

New
----------------

* Sorter: new class Sorter developed from image-sorter module
* mysql-dump: new module added

Modified
----------------

* Date_Time_Format: get_days and get_months methods created
* Date_Time_Format: get_days and get_months methods php and json return values
* Date_Time_Format: refactoring class
* Directory_Lister: avoiding case of empty directory in files method
* Export: export file column dimension auto size
* Export: csv export set to avoid PHPExcel output because of double quotes
* File: read_file_contents method created
* File: write_to_file method - added new parameter to determine if file is written to top or bottom
* Format: array_to_string method created
* Format: fullname method created
* Format: search_wizard method created
* Format: language_value method created
* Format: add_to_array method created
* Geo_Plugin: collect method base sub-array location parameter prefixed with https/http query and added as a special parameter in base sub-array
* User: image method refactoring
* Web_Service: response method created

Removed
----------------

* Pagination: entire class removed from php-library because of it's redundancy
* image-sorter: entire module removed and replaced with Sorter class
* spider: entire module removed from php-library

Since php-library v1.0.0 (26-Oct-2017)
=======

Important
----------------

* Namespace phplibrary added to every class and home page edits

New
----------------
* Spider module added
* Math class created
* Geo_Plugin class created as third-party geoPlugin extension
* Module image-sorter added
* PHPExcel added

Modified
----------------

* Date_Time_Format: Variables reformated to $types array
* Date_Time_Format: days_before method added
* Directory_Lister: file size added to file method
* Export: allowed_types method added
* Math: static keyword added to percentage method
* User_Agent: class development and refactoring
* Web_Service: New methodes developed
* Website: creator method added
