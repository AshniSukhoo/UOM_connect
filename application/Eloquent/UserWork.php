<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserWork
 * @package App\Eloquent
 */
class UserWork extends  Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_works';

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
        'job_title',
        'company_name',
        'date_joined',
        'date_left',
        'is_current',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date_joined', 'date_left'];

    /**
     * A work belongs to one user only
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //Return the user owner of this work item
        return $this->belongsTo('App\Eloquent\User', 'user_id', 'id');
    }
}