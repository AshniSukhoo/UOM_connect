<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateAccountVerificationTable */
class CreateAccountVerificationTable extends Migration
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
        $this->schema->create('account_verification_tokens', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('token', 100);
            $table->enum('status', ['active', 'expired']);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop foreign
        $this->schema->table('account_verification_tokens', function($table) {
            $table->dropForeign('account_verification_tokens_user_id_foreign');
        });
        //Drop the table
        $this->schema->dropIfExists('account_verification_tokens');
    }
}