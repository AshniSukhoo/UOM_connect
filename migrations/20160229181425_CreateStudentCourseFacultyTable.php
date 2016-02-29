<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateStudentCourseFacultyTable */
class CreateStudentCourseFacultyTable extends Migration
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
        //Create Faculty Table
        $this->schema->create('faculties', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        //Create Courses Table
        $this->schema->create('courses', function($table) {
            $table->increments('id');
            $table->string('course_name');
            $table->integer('faculty_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        //Add foreign key on courses table
        $this->schema->table('courses', function($table) {
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });

        //Create student courses faculties details
        $this->schema->create('students_courses_faculties', function($table) {
            $table->increments('id');
            $table->string('uom_id', 50);
            $table->integer('faculty_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->timestamps();
        });

        //Add foreign keys
        $this->schema->table('students_courses_faculties', function($table) {
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
        $this->schema->table('students_courses_faculties', function($table) {
            $table->dropForeign('students_courses_faculties_uom_id_foreign');
            $table->dropForeign('students_courses_faculties_faculty_id_foreign');
            $table->dropForeign('students_courses_faculties_course_id_foreign');
        });

        $this->schema->table('courses', function($table) {
            $table->dropForeign('courses_faculty_id_foreign');
        });

        //Drop table
        $this->schema->dropIfExists('students_courses_faculties');
        $this->schema->dropIfExists('courses');
        $this->schema->dropIfExists('faculties');
    }
}
