#!/bin/bash

# Define color
GREEN='\033[0;32m'
# Define no-color
NC='\033[0m'

# Print message
echo -e "${GREEN}Started auto-test shell script${NC}\n"

# Run coding standard for index.php file
vendor/bin/phpcs index.php --standard='ruleset.xml' --colors

# Print message
echo -e "${GREEN}Finished PHP_CodeSniffer for custom files${NC}"

# Run coding standard for src folder
vendor/bin/phpcs src/ --standard='ruleset.xml' --colors

# Print message
echo -e "${GREEN}Finished PHP_CodeSniffer for src folder${NC}"

# Run coding standard for tests folder
vendor/bin/phpcs tests/ --standard='ruleset.xml' --colors

# Print message
echo -e "${GREEN}Finished PHP_CodeSniffer for tests folder${NC}"

# Run PHP static analysis
vendor/bin/phpstan analyse src --level max

# Print message
echo -e "${GREEN}Finished PHPStan for src folder${NC}\n"

# Run PHPUnit
vendor/bin/phpunit

# Print message
echo -e "${GREEN}Finished PHPUnit for test folder${NC}\n"

# Print message
echo -e "${GREEN}Finished auto-test shell scriptt${NC}"
