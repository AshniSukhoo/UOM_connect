<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateUomValidIdsTable */
class CreateUomValidIdsTable extends Migration
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
        //Create the table
        $this->schema->create('uom_valid_ids', function($table) {
            $table->string('id', 50);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->enum('type', ['student', 'lecturer']);
            $table->timestamp('datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('valide');
            $table->boolean('has_account');

            $table->primary('id');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop the table
        $this->schema->dropIfExists('uom_valid_ids');
    }
}