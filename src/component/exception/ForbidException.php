<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 2018/12/25
 * Time: 14:44
 */

namespace by\component\exception;

class ForbidException extends BaseException
{
    public function __construct($message = "permission denied", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
