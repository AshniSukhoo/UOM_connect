<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class AddPrimaryKeyToCISessionsTbale */
class AddPrimaryKeyToCISessionsTbale extends Migration
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
        $this->schema->table('ci_sessions', function($table) {
            $table->primary('session_id');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->schema->table('ci_sessions', function($table) {
            $table->dropPrimary('ci_sessions_session_id_primary');
        });
    }
}