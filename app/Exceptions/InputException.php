<?php
/**
 * Created by PhpStorm.
 * User: alan.ting
 * Date: 2019-08-27
 * Time: 14:35
 */

namespace App\Exceptions;

use Exception;

class InputException extends Exception
{
    private $_message = 'Input error.';

    /**
     * InputException constructor.
     *
     * @param string $errorMessage
     */
    public function __construct(String $errorMessage = null)
    {
        if (! empty($errorMessage)) {
            $this->_message .= ' ' . $errorMessage;
        }
        parent::__construct($this->_message);
    }
}
