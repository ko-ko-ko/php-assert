<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\request;

use index0h\validator\Variable;

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return Variable
     */
    public function get($name, $default = null);

    /**
     * @param string $name
     * @param bool   $default
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toBool($name, $default = false);

    /**
     * @param string $name
     * @param float  $default
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toFloat($name, $default = 0.0);

    /**
     * @param string $name
     * @param int    $default
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toInt($name, $default = 0);

    /**
     * @param string $name
     * @param string $default
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toString($name, $default = '');
}
