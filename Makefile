
test:
	php ./.test.php run --xml --html --coverage-html --coverage-xml

benchmark:
	php ./.test.php benchmark:variable
	php ./.test.php benchmark:cast

.PHONY: test benchmark
