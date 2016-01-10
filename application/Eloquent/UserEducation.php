<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserEducation
 * @package App\Eloquent
 */
class UserEducation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_educations';

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
        'institution_name',
        'major',
        'year_joined',
        'year_left',
        'is_current',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * An eduction item belongs to one user only
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //Return the user owner of this education item
        return $this->belongsTo('App\Eloquent\User', 'user_id', 'id');
    }
}