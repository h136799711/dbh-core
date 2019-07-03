<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 2018/12/21
 * Time: 12:35
 */

namespace by\component\exception;


use by\infrastructure\constants\BaseErrorCode;
use Throwable;

class RateLimitResponseException extends \Exception
{
    public function __construct($message = '' , $code = BaseErrorCode::Api_Request_Rate_Limit, Throwable $previous = null)
    {
        parent::__construct("api request rate limit", $code, $previous);
    }

}
