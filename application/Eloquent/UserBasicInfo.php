<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\UserBasicInfoPresenter;

/**
 * Class UserBasicInfo
 *
 * @package App\Eloquent
 */
class UserBasicInfo extends Model
{
    /**
     * Models trait
     */
    use UserBasicInfoPresenter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_basic_info';

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
        'address',
        'city',
        'country',
        'phone_number',
        'emails',
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