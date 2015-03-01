
test:
	php ./vendor/bin/codecept run --coverage-xml

benchmark:
	php ./.test.php benchmark

.PHONY: test benchmark
