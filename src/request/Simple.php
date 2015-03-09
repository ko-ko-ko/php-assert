<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\request;

/**
 * Class Simple
 */
class Simple extends AbstractRequest
{
    /** @type array */
    protected $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (empty($data)) {
            $data = array_merge($_GET, $_POST);
        }

        $this->data = $data;
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function getParam($name, $default = null)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        return isset($data[$name]) ? $_GET[$name] : $default;
    }
}