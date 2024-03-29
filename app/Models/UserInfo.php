<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    /**
     * The table name that belongs this model.
     *
     * @var string
     */
    protected $table = 'users_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'rfc',
        'cell_phone_number',
        'user_id'
    ];


    /* * * * RELATIONSHIPS * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    /**
     * Get the user that owns the user info.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
