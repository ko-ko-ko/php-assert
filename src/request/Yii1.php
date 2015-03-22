<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\request;

use CHttpRequest;

/**
 * Class Yii
 */
class Yii1 extends AbstractRequest
{
    /** @type CHttpRequest */
    protected $request;

    /**
     * @param CHttpRequest $request
     */
    public function __construct(CHttpRequest $request)
    {
        $this->request = $request;
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

        return $this->request->getParam($name, $default);
    }
}