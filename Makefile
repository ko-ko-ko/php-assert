
test:
	php ./.test.php run --coverage --xml --html

benchmark:
	php ./.test.php benchmark

.PHONY: test benchmark
