<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateAccountStatusTable
 */
class CreateAccountStatusTable extends Migration
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
        //Create
        $this->schema->create('account_status', function ($table) {
            $table->increments('id');
            $table->string('value', 200);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop table
        $this->schema->dropIfExists('account_status');
    }
}