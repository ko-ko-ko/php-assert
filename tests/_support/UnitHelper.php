<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */
namespace Codeception\Module;

use Codeception\Module;

/**
 * Class UnitHelper
 */
class UnitHelper extends Module
{
    /** @var array */
    private static $fixtures;

    /**
     * @param string $methodName
     *
     * @return array
     */
    public function getFixturesForMethod($methodName)
    {
        $result = [];
        foreach ($this->getFixtures() as $fixture) {
            if (!isset($fixture['errors'][$methodName])) {
                continue;
            }

            if (!isset($fixture['arguments'])) {
                $fixture['arguments'] = [];
            }

            $fixture['errors'] = $fixture['errors'][$methodName];

            $result[] = $fixture;
        }

        return $result;
    }

    /**
     * @return array
     */
    private function getFixtures()
    {
        if (!is_null(self::$fixtures)) {
            return self::$fixtures;
        }

        self::$fixtures = require_once __DIR__ . '/../_data/fixtures.php';

        return self::$fixtures;
    }
}
