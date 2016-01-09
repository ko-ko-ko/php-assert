<?php

namespace KoKoKo\assert\tests;

class BaseUnitTestCase extends \PHPUnit_Framework_TestCase
{
    const NULL_FIXTURE     = 'null';
    const BOOL_FIXTURE     = 'bool';
    const INT_FIXTURE      = 'int';
    const FLOAT_FIXTURE    = 'float';
    const STRING_FIXTURE   = 'string';
    const ARRAY_FIXTURE    = 'array';
    const OBJECT_FIXTURE   = 'object';
    const RESOURCE_FIXTURE = 'resource';

    /**
     * @return array
     */
    public function getTypeFixtures()
    {
        return [
            self::NULL_FIXTURE     => null,
            self::BOOL_FIXTURE     => true,
            self::INT_FIXTURE      => 0,
            self::FLOAT_FIXTURE    => 0.0,
            self::STRING_FIXTURE   => '',
            self::ARRAY_FIXTURE    => [],
            self::OBJECT_FIXTURE   => new \StdClass,
            self::RESOURCE_FIXTURE => stream_context_create(),
        ];
    }

    /**
     * @param array $fixtureNames
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getTypeFixturesWithout(array $fixtureNames)
    {
        $result = $this->getTypeFixtures();

        foreach ($fixtureNames as $typeName) {
            if (array_key_exists($typeName, $result) === false) {
                throw new \InvalidArgumentException(
                    sprintf('Unknown type fixture name: "%s"', $typeName)
                );
            }

            unset($result[$typeName]);
        }

        return $result;
    }

    /**
     * @param string $fixtureName
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getTypeFixture($fixtureName)
    {
        $result = $this->getTypeFixtures();

        if (array_key_exists($fixtureName, $result) === false) {
            throw new \InvalidArgumentException(
                sprintf('Unknown type fixture name: "%s"', $fixtureName)
            );
        }

        return $result[$fixtureName];
    }
}