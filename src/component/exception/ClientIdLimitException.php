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

class ClientIdLimitException extends \Exception
{
    /**
     * ClientIdLimitException constructor.
     * @param string|array $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'client id limit' , $code = BaseErrorCode::Api_Request_Rate_Limit, Throwable $previous = null)
    {
        parent::__construct('', $code, $previous);
        $this->message = $message;
    }

}
