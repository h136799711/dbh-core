<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/8/9
 * Time: 17:44
 */

namespace by\component\exception;


use by\infrastructure\constants\BaseErrorCode;
use Exception;
use Throwable;

class UglyException extends Exception
{
    public function __construct($message = "", $code = BaseErrorCode::Api_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
