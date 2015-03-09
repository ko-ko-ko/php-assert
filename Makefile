
test:
	php ./.test.php run --xml --html --coverage-html --coverage-xml

benchmark:
	php ./.test.php benchmark

.PHONY: test benchmark
