#!/bin/bash

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Started auto-test shell script$(tput sgr 0)\n"

# Run coding standard for index.php file
vendor/bin/phpcs index.php --standard='ruleset.xml' --colors

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Finished PHP_CodeSniffer for custom files$(tput sgr 0)"

# Run coding standard for src folder
vendor/bin/phpcs src/ --standard='ruleset.xml' --colors

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Finished PHP_CodeSniffer for src folder$(tput sgr 0)"

# Run coding standard for tests folder
vendor/bin/phpcs tests/ --standard='ruleset.xml' --colors

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Finished PHP_CodeSniffer for tests folder$(tput sgr 0)"

# Run PHP static analysis
vendor/bin/phpstan analyse src --level max

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Finished PHPStan for src folder$(tput sgr 0)\n"

# Run PHPUnit
vendor/bin/phpunit

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Finished PHPUnit for test folder$(tput sgr 0)\n"

# Print message
echo -e "$(tput setaf 0)$(tput setab 2)Finished auto-test shell scriptt$(tput sgr 0)"
