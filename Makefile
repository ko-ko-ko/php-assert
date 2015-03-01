
test:
	php ./vendor/bin/codecept run --coverage-xml --quiet

benchmark:
	php ./.test.php benchmark

.PHONY: test benchmark
