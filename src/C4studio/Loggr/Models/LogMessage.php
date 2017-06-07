<?php

namespace C4studio\Loggr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class LogMessage extends Model {

    const CREATED_AT = 'timestamp';
    const UPDATED_AT = null;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['timestamp'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['owner_id', 'message', 'data'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';




    /**
     * Get owner of log message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(Config::get('auth.providers.users.model'), 'owner_id');
    }

}