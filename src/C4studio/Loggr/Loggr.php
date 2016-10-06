<?php

namespace C4studio\Loggr;

use C4studio\Loggr\Models\LogMessage;
use Illuminate\Support\Facades\Config;

class Loggr {

    private static $user_model;



    public function __construct()
    {
        self::$user_model = Config::get('auth.providers.users.model');
    }



    /**
     * Loggr::add(string $message [, User|int $owner])
     *
     * Adds new log message
     *
     * @param string $message
     * @param \App\Models\User|int $owner
     * @return LogMessage|bool
     */
    public static function add($message, $owner = null)
    {
        if (!is_null($owner)) {
            if (is_a($owner, self::$user_model))
                $owner_id = $owner->id;
            elseif (is_int($owner))
                $owner_id = $owner;
            else
                return false;
        } else
            $owner_id = null;

         return LogMessage::create([
            'message' => $message,
            'owner_id' => $owner_id
         ]);
    }

    /**
     * Loggr::get()
     *
     * Returns all log messages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function get()
    {
        return LogMessage::all();
    }

    /**
     * Loggr::interval([$start] [, $end])
     *
     * Returns all log messages in time interval
     *
     * @param \Carbon\Carbon $start
     * @param \Carbon\Carbon $end
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function interval($start = null, $end = null)
    {
        $query = LogMessage::query();

        if (!is_null($start))
            $query->where('timestamp', '>=', $start);
        if (!is_null($end))
            $query->where('timestamp', '<=', $end);

        return $query->get();
    }

    /**
     * Loggr::owner(User|int $owner)
     *
     * Returns all log messages belonging to owner
     *
     * @param \App\Models\User|int $owner
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function owner($owner)
    {
        if (is_a($owner, self::$user_model))
            return LogMessage::where('owner_id', $owner->id)->get();
        elseif (is_int($owner))
            return LogMessage::where('owner_id', $owner)->get();
        else
            throw new \InvalidArgumentException('owner() only accepts arguments of type User and int');
    }

    /**
     * Loggr::query()
     *
     * Returns builder object for more complex queries, for ex.:
     * Loggr::query()->orderBy('timestamp', 'desc')->take(2)->get();
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function query()
    {
        return LogMessage::query();
    }

}