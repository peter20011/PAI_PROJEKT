<?php

class CannotAddRecordException extends Exception
{
    private $textToDisplay;

    public function __construct($displayText, $message = '', $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);

        $this->textToDisplay = $displayText;
    }

    public function display() {
        return $this->textToDisplay;
    }
}