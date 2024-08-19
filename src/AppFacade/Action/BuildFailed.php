<?php

namespace Merijn\Pegasus\AppFacade\Action;

class BuildFailed extends \Exception
{
    private function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function noBotsDefined() : BuildFailed
    {
        return new BuildFailed("Add a collection of bots that needs to perform this action.");
    }

    public static function noHotelDefined(): BuildFailed
    {
        return new BuildFailed("Define a hotel for Pegasus to target.");
    }

    public static function noActionDefined(): BuildFailed
    {
        return new BuildFailed("Define an action.");
    }
}