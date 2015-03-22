
test:
	php ./vendor/bin/codecept run --xml --html --coverage-html --coverage-xml

benchmark:
	php ./.benchmark.php benchmark:variable
	php ./.benchmark.php benchmark:cast
	php ./.benchmark.php benchmark:respect

.PHONY: test benchmark
