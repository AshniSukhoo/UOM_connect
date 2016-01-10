<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\UserPresenter;
use App\ModelFunctions\UserFunctions;

/**
 * Class User
 * @package App\Eloquent
 */
class User extends Model
{
    /**
     * Model's trait
     */
    use UserPresenter, UserFunctions;

    /**
     * Table name to use
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields to be treated as
     * Carbon instance
     * @var array
     */
    protected $dates = ['datetime_joined', 'date_of_birth'];

    /**
     * Whether the model
     * should be timestamped
     * @var bool
     */
    public $timestamps = false;

    /**
     * Whether to use auto-increment
     * @var bool
     */
    public $incrementing = true;

    /**
     * Fields that are mass assignable
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'user_type',
        'date_of_birth',
        'gender',
        'uom_id',
        'account_status',
        'datetime_joined',
    ];

    /**
     * Hidden field
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * One user has only one basic info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function basicInfo()
    {
        //Return relationship
        return $this->hasOne('App\Eloquent\UserBasicInfo', 'user_id', 'id');
    }

    /**
     * A user can have many work
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function works()
    {
        //Return all user works
        return $this->hasMany('App\Eloquent\UserWork', 'user_id', 'id');
    }

    /**
     * A user can have many education
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function educations()
    {
        //Return all user educations
        return $this->hasMany('App\Eloquent\UserEducation', 'user_id', 'id');
    }

    /**
     * A user has one detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        //Retun detail
        return $this->hasOne('App\Eloquent\UserDetails', 'user_id', 'id');
    }
}