<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateNotificationsTable */
class CreateNotificationsTable extends Migration
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
        //Create notifications table
	    $this->schema->create('notifications', function ($table) {
		    $table->increments('id');
		    $table->integer('receiver')->unsigned();
		    $table->integer('notifier')->unsigned();
		    $table->text('content');
		    $table->boolean('notified');
		    $table->enum('type', ['like', 'comment', 'friended']);
		    $table->timestamps();
		    $table->softDeletes();
	    });

	    //Add foreign keys to table
	    $this->schema->table('notifications', function ($table) {
		    $table->foreign('receiver')->references('id')->on('users');
		    $table->foreign('notifier')->references('id')->on('users');
	    });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
	    //Drop foreign keys
	    $this->schema->table('notifications', function ($table) {
		    $table->dropForeign('notifications_receiver_foreign');
		    $table->dropForeign('notifications_notifier_foreign');
	    });
        //Drop notifications table
	    $this->schema->dropIfExists('notifications');
    }
}
