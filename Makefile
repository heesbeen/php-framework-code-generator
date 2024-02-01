phpunit:
	vendor/bin/phpunit --testdox --coverage-text --coverage-html=var/coverage

mutation:
	vendor/bin/infection --min-msi=100 --min-covered-msi=100 --only-covered --show-mutations --threads=max

code-checks:
	@echo "\n=== API: Running linting check ===\n"
	vendor/bin/phpcs --standard=PSR2 src
	@echo "\n=== API: Running code style check ===\n"
	vendor/bin/php-cs-fixer fix --diff --dry-run

code-fix:
	vendor/bin/php-cs-fixer fix --diff
