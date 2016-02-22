<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateFriendRequestTable */
class CreateFriendRequestTable extends Migration
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
	    $this->schema->create('friend_requests', function ($table) {
		    $table->increments('id');
		    $table->integer('sender')->unsigned();
		    $table->integer('receiver')->unsigned();
		    $table->boolean('notified');
		    $table->timestamps();
		    $table->softDeletes();
	    });

	    //Add foreign keys
	    $this->schema->table('friend_requests', function ($table) {
		    $table->foreign('sender')->references('id')->on('users');
		    $table->foreign('receiver')->references('id')->on('users');
	    });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Drop foreign keys
	    $this->schema->table('friend_requests', function($table) {
		    $table->dropForeign('friend_requests_sender_foreign');
		    $table->dropForeign('friend_requests_receiver_foreign');
	    });

	    //Drop table
	    $this->schema->dropIfExists('friend_requests');
    }
}
