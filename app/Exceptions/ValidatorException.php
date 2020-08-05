<?php

namespace App\Exceptions;

/**
 * Class ValidatorException.
 */
class ValidatorException extends \Exception
{
    /**
     * @var array Hold error bag.
     */
    private array $errors = [];

    /**
     * ValidatorException constructor.
     *
     * @param array|string $errors
     */
    public function __construct($errors = [])
    {
        if (is_string($errors)) {
            $message = $errors;
        } else {
            $this->errors = $errors;
            $message = 'Bad request.';
        }

        parent::__construct($message, 400);
    }

    /**
     * Return the error bag.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }
}