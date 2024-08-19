<?php

namespace Merijn\Pegasus\AppFacade;

use Exception;

class OpenDirectoryFailed extends Exception
{
    public static function directoryNotFound(string $directory): OpenDirectoryFailed
    {
        return new OpenDirectoryFailed("Directory '$directory' cannot be opened. Does it exist?");
    }
}