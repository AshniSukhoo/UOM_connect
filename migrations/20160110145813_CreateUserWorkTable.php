<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateUserWorkTable */
class CreateUserWorkTable extends Migration
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
        //Create user work table
        $this->schema->create('user_works', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('job_title');
            $table->string('company_name');
            $table->dateTime('date_joined');
            $table->dateTime('date_left')->nullable();
            $table->boolean('is_current');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
	    $this->schema->table('user_works', function($table) {
		    $table->dropForeign('user_works_user_id_foreign');
	    });
        //Drop table
        $this->schema->dropIfExists('user_works');
    }
}