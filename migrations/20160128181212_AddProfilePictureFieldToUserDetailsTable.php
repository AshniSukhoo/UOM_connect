<?php 
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class AddProfilePictureFieldToUserDetailsTable */
class AddProfilePictureFieldToUserDetailsTable extends Migration
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
        //Add field
	    $this->schema->table('user_details', function($table) {
		    $table->string('profile_picture')->nullable()->after('user_id');
	    });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        //Remove Field
	    $this->schema->table('user_details', function($table) {
		    $table->dropColumn('profile_picture');
	    });
    }
}