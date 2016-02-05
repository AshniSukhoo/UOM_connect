<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateUserEducationTabls */
class CreateUserEducationTabls extends Migration
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
        //Create eduction table
        $this->schema->create('user_educations', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('institution_name');
            $table->string('major');
            $table->string('year_joined');
            $table->string('year_left')->nullable();
            $table->boolean('is_current');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
	    $this->schema->table('user_educations', function($table) {
		    $table->dropForeign('user_educations_user_id_foreign');
	    });
        //Drop table
        $this->schema->dropIfExists('user_educations');
    }
}