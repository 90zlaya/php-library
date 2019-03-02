Since php-library v1.5.1 (07-Dec-2018)
=======

Important
----------------

* Changed namespaces for every class in library
* Changed folder structure
* Testing: new class created to be extended by core classes
* Messages: new class created to be extended by Testing class

* Directory_Lister: modified structure of files array and sorted by title
* Directory_Lister: removed file display option
* File_Version: class removed from library
* Operating_System: class removed from library
* Sorter: multidimensional_array method moved to Format class
* Sorter: entire class refactored
* User: attributes and methods redefined and moved to File class
* Web_Service: class is not static anymore
* Website: redirect_to_page method removed

New
----------------

* Dump: new class developed and tested
* Password: digest method added
* User_Agent: detect_operating_system method added
* User_Agent: list_operating_systems method added

Modified
----------------

* User_Agent: list_operating_systems method sort names alphabetically
* User_Agent: list_operating_systems method duplicate operating systems removed
* User_Agent: list_operating_systems method option to group operating systems
* User_Agent: detect_operating_system method returns array instead of string
