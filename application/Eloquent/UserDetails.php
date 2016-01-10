<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDetails
 * @package App\Eloquent
 */
class UserDetails extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_details';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'hobbies',
        'interests',
        'about',
    ];

    /**
     * Whether the model
     * should be timestamped
     * @var bool
     */
    public $timestamps = false;

    /**
     * A user info belongs to only one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //return relationship
        return $this->belongsTo('App\Eloquent\User', 'user_id', 'id');
    }
}