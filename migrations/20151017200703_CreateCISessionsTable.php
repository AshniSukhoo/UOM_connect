<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateCISessionsTable */
class CreateCISessionsTable extends Migration
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
        $this->schema->create('ci_sessions', function($table) {
            $table->string('session_id', 40);
            $table->string('ip_address', 45);
            $table->string('user_agent', 120);
            $table->integer('last_activity')->unsigned();
            $table->text('user_data');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop table
        $this->schema->dropIfExists('ci_sessions');
    }
}