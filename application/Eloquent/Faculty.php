<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Faculty
 *
 * @package App\Eloquent
 */
class Faculty extends Model
{
    /**
     * Model's trait
     */
    use SoftDeletes;

    /**
     * The table name to use with the model
     *
     * @var string
     */
    protected $table = 'faculties';

    /**
     * The primary key of the model
     *
     * @var string
     */
    protected $primaryKey = 'id';

	/**
     * Weather the model uses auto-increment
     *
     * @var bool
     */
	public $incrementing = true;

	/**
	 * Weather the model uses timestamps
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * The attributes to be casted to carbon
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * Fillable Array
	 *
	 * array
	 */
	protected $fillable = [
		'id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
	];

    /**
     * All the courses that the faculty has
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        //A Faculty contains many courses
        return $this->hasMany('App\Eloquent\Course', 'faculty_id', 'id');
    }
}
