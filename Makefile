
test:
	php ./.test.php run --xml --html --coverage --coverage-html

benchmark:
	php ./.test.php benchmark

.PHONY: test benchmark
