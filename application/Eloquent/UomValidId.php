<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UomValidId
 * @package App\Eloquent
 */
class UomValidId extends Model
{
    /**
     * Table name to use
     * @var string
     */
    protected $table = 'uom_valid_ids';

    /**
     * The primary to use
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are mass assignable
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'type',
        'datetime',
        'valide',
        'has_account'
    ];

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
    public $incrementing = false;

    /**
     * Fields that are
     * considered as carbon instance
     * @var array
     */
    protected $dates = ['datetime'];

    /**
     * All faculties for this Uom_id
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function faculties()
    {
        //Return all faculties
        return $this->belongsToMany('App\Eloquent\Faculty', 'students_courses_faculties', 'uom_id', 'faculty_id');
    }

    /**
     * All courses for this Uom_id
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        //Return all courses
        return $this->belongsToMany('App\Eloquent\Course', 'students_courses_faculties', 'uom_id', 'course_id');
    }
}
