<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\request;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Symfony
 */
class Symfony extends AbstractRequest
{
    /** @var \Symfony\Component\HttpFoundation\ParameterBag */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request->request;
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     * @throws \InvalidArgumentException
     */
    protected function getParam($name, $default = null)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        return $this->request->get($name, $default);
    }
}
