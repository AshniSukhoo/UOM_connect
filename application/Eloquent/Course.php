<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App\Eloquent
 */
class Course extends Model
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
    protected $table = 'courses';
    
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
        'course_name',
        'faculty_id',
        'created_at',
        'updated_at',
        'deleted_at',
	];

    /**
     * The faculty to which the course belongs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty()
    {
        //Belongs to one faculty only
        return $this->belongsTo('App\Eloquent\Faculty', 'faculty_id', 'id');
    }
}
