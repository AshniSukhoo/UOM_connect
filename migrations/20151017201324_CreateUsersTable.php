<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateUsersTable */
class CreateUsersTable extends Migration
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
        $this->schema->create('users', function($table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 200)->unique();
            $table->string('password', 100);
            $table->enum('user_type', ['student', 'lecturer']);
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->string('uom_id', 50)->unique();
            $table->integer('account_status')->unsigned();
            $table->string('remember_me', 100);
            $table->timestamp('datetime_joined')->default(DB::raw('CURRENT_TIMESTAMP'));

            //Add foreign key constrains
            $table->foreign('uom_id')->references('id')->on('uom_valid_ids');
            $table->foreign('account_status')->references('id')->on('account_status');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop foreign keys
        $this->schema->table('users', function($table) {
            $table->dropForeign('users_uom_id_foreign');
            $table->dropForeign('users_account_status_foreign');
        });
        //Drop the table
        $this->schema->dropIfExists('users');
    }
}