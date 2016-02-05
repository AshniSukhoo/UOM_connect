<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class CreateLikeTable */
class CreateLikeTable extends Migration
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
	    $this->schema->create('likes', function($table) {
		    $table->increments('id');
		    $table->integer('user_id')->unsigned();
		    $table->string('resourceable_type');
		    $table->string('resourceable_id');
		    $table->timestamps();
		    $table->softDeletes();

		    $table->foreign('user_id')->references('id')->on('users');
	    });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
	    //Drop foreign
	    $this->schema->table('likes', function($table) {
		    $table->dropForeign('likes_user_id_foreign');
	    });
	    $this->schema->dropIfExists('likes');
    }
}