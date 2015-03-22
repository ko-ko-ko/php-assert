
test:
	php ./vendor/bin/codecept run --xml --html --coverage-html --coverage-xml

benchmark:
	php ./.benchmark.php benchmark:variable
	php ./.benchmark.php benchmark:cast

.PHONY: test benchmark
