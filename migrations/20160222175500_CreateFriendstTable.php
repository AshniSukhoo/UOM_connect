<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateFriendstTable
 */
class CreateFriendstTable extends Migration
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
	    //Create friends table
	    $this->schema->create('friends', function($table) {
            $table->increments('id');
		    $table->integer('user_id_1')->unsigned();
		    $table->integer('user_id_2')->unsigned();
		    $table->timestamps();
	    });

	    //Add foreign keys
	    $this->schema->table('friends', function($table) {
		    $table->foreign('user_id_1')->references('id')->on('users');
		    $table->foreign('user_id_2')->references('id')->on('users');
	    });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop foreign keys
	    $this->schema->table('friends', function($table) {
		    $table->dropForeign('friends_user_id_1_foreign');
		    $table->dropForeign('friends_user_id_2_foreign');
	    });

	    //Drop table
	    $this->schema->dropIfExists('friends');
    }
}
