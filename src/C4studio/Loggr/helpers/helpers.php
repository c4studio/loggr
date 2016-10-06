<?php

if (!function_exists('loggr')) {

    /**
     * Helper function for calling add() method on underlying Loggr service
     *
     * @param string $message
     * @param \App\Models\User|int $owner
     * @return LogMessage|bool
     */
    function loggr($message, $owner = null)
    {
        return \C4studio\Loggr\Facades\Loggr::add($message, $owner);
    }

}
