<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateUserDetailsTable */
class CreateUserDetailsTable extends Migration
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
        //Create user details table
        $this->schema->create('user_details', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('hobbies');
            $table->text('interests');
            $table->text('about');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop user details table
        $this->schema->dropIfExists('user_details');
    }
}