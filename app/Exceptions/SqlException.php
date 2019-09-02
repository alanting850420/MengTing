<?php
/**
 * Created by PhpStorm.
 * User: alan.ting
 * Date: 2019-08-27
 * Time: 14:07
 */

namespace App\Exceptions;

use Exception;

class SqlException extends Exception
{
    private $_message = 'SQL error. ';

    private $_sql_query = '';
    private $_sql_error_msg = '';

    /**
     * SqlException constructor.
     *
     * @param string $errorMessage
     */
    public function __construct(String $errorMessage = null)
    {
        if (! empty($errorMessage)) {
            $messageArr = explode('(SQL: ', $errorMessage);
            $this->_sql_error_msg = rtrim($messageArr[0]);
            $this->_message .= $this->_sql_error_msg;
        }

        if (! empty($messageArr[1])) {
            $this->_sql_query = rtrim(substr($messageArr[1], 0, -1));
        }
        parent::__construct($this->_message);
    }

    public function getQuery()
    {
        return $this->_sql_query;
    }
}
