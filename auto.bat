clear

echo Started PHP_CodeSniffer for src folder
vendor/bin/phpcs index.php --standard='ruleset.xml'
vendor/bin/phpcs src/Date_Time_Format.php --standard='ruleset.xml'
vendor/bin/phpcs src/Directory_Lister.php --standard='ruleset.xml'
vendor/bin/phpcs src/Email.php --standard='ruleset.xml'
vendor/bin/phpcs src/Export.php --standard='ruleset.xml'
vendor/bin/phpcs src/File.php --standard='ruleset.xml'
vendor/bin/phpcs src/File_Version.php --standard='ruleset.xml'
vendor/bin/phpcs src/Format.php --standard='ruleset.xml'
vendor/bin/phpcs src/Geo_Plugin.php --standard='ruleset.xml'
vendor/bin/phpcs src/Math.php --standard='ruleset.xml'
vendor/bin/phpcs src/Operating_System.php --standard='ruleset.xml'
vendor/bin/phpcs src/Password.php --standard='ruleset.xml'
vendor/bin/phpcs src/Random.php --standard='ruleset.xml'
vendor/bin/phpcs src/Sorter.php --standard='ruleset.xml'
vendor/bin/phpcs src/Temperature.php --standard='ruleset.xml'
vendor/bin/phpcs src/User.php --standard='ruleset.xml'
vendor/bin/phpcs src/User_Agent.php --standard='ruleset.xml'
vendor/bin/phpcs src/Validation.php --standard='ruleset.xml'
vendor/bin/phpcs src/Web_Service.php --standard='ruleset.xml'
vendor/bin/phpcs src/Website.php --standard='ruleset.xml'
echo Finished PHP_CodeSniffer for src folder

echo Started PHP_CodeSniffer for tests folder
vendor/bin/phpcs tests/Email_Test.php --standard='ruleset.xml'
vendor/bin/phpcs tests/Geo_Plugin_Test.php --standard='ruleset.xml'
vendor/bin/phpcs tests/Math_Test.php --standard='ruleset.xml'
vendor/bin/phpcs tests/Operating_System_Test.php --standard='ruleset.xml'
vendor/bin/phpcs tests/User_Test.php --standard='ruleset.xml'
vendor/bin/phpcs tests/Web_Service_Test.php --standard='ruleset.xml'
vendor/bin/phpcs tests/Website_Test.php --standard='ruleset.xml'
echo Finished PHP_CodeSniffer for tests folder

vendor/bin/phpstan analyse src --level 7

vendor/bin/phpunit

php phpDocumentor.phar -d src -t api