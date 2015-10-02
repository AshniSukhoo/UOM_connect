<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Eloquent
 */
class User extends Model
{
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
}