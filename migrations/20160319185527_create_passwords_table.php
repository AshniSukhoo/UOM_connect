<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreatePasswordsTable */
class CreatePasswordsTable extends Migration
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
        //Create passwords table
        $this->schema->create('passwords', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        //Add foreign key to table
        $this->schema->table('passwords', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop foreign keys
        $this->schema->table('passwords', function($table) {
            $table->dropForeign('passwords_user_id_foreign');
        });

        //Drop passwords table
        $this->schema->dropIfExists('passwords');
    }
}
