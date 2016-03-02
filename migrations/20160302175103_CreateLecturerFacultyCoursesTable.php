<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateLecturerFacultyCoursesTable */
class CreateLecturerFacultyCoursesTable extends Migration
{
    /**
     * The Eloquent Capsule
     *
     * @var \Illuminate\Database\Capsule\Manager
     */
    protected $capsule;

    /**
     * The schema builder
     *
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Pimple Container
     *
     * @var \Phpmig\Pimple\Pimple
     */
    protected $container;

    /**
     * Init the migration
     */
    public function init()
    {
        //Get the Container
        $container = $this->getContainer();
        //Get Eloquent capsule
        $this->capsule = $container['db'];
        //Get schema builder instance
        $this->schema = $this->capsule->schema();
    }

    /**
     * Do the migration
     */
    public function up()
    {
        //Create table
        $this->schema->create('lecturers_courses_faculties', function($table) {
            $table->increments('id');
            $table->string('uom_id', 50);
            $table->integer('faculty_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->timestamps();
        });

        //Add foreign keys
        $this->schema->table('lecturers_courses_faculties', function($table) {
            $table->foreign('uom_id')->references('id')->on('uom_valid_ids');
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop foreign keys
        $this->schema->table('lecturers_courses_faculties', function($table) {
            $table->dropForeign('lecturer_courses_faculties_uom_id_foreign');
            $table->dropForeign('lecturer_courses_faculties_faculty_id_foreign');
            $table->dropForeign('lecturer_courses_faculties_course_id_foreign');
        });

        //Drop table
        $this->schema->dropIfExists('lecturers_courses_faculties');
    }
}
