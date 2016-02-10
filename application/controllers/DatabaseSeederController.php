<?php

use App\Eloquent\UomValidId;
use App\Eloquent\User;
use App\Eloquent\Post;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class DatabaseSeederController
 */
class DatabaseSeederController extends CI_Controller
{
    /**
     * The faker object
     * @var
     */
    protected $faker;

    /**
     * Create new instance of the Controller
     */
    public function __construct()
    {
        //Call parent constructor
        parent::__construct();
        //Create faker object
        $this->faker = Faker\Factory::create();
    }

    /**
     * Seeding active users to database
     */
    public function SeedActiveUsers()
    {
        //Unguard model
        Model::unguard();

        //Generate 200 users
        for($i = 0; $i < 200; $i++) {
            //Start generating Fake data for UomValidId
            $uomId = $this->faker->randomNumber(9);
            $fistName = $this->faker->firstName;
            $lastName = $this->faker->lastName;
            $type = $this->faker->randomElement(['student', 'lecturer']);
            $datetime = $this->faker->dateTimeBetween('-1 years', 'now');

            UomValidId::create([
                'id' => $uomId,
                'first_name' => $fistName,
                'last_name' => $lastName,
                'type' => $type,
                'datetime' => $datetime,
                'valide' => 1,
                'has_account' => 1
            ]);

            User::create([
                'first_name' => $fistName,
                'last_name' => $lastName,
                'email' => $this->faker->email,
                'password' => $this->auth->encryptPassword('password'),
                'user_type' => $type,
                'date_of_birth' => $this->faker->dateTimeBetween('- 65 years', '- 18 years')->format('Y-m-d'),
                'gender' => $this->faker->randomElement(['male', 'female']),
                'uom_id' => $uomId,
                'account_status' => 1,
                'datetime_joined' => $datetime
            ]);
        }

        Model::reguard();

        echo '200 Users created';
    }

	/**
	 * Seeding posts
	 */
	public function seedPosts($userId = '', $numberPost = 20)
	{
		//Unguard model
		Model::unguard();

		//Generate posts for specific user
		for($i = 0; $i < $numberPost; $i++) {
			$randDate = $this->faker->dateTimeBetween('-1years', 'now');
			Post::create([
				'user_id' => $userId,
				'content' => $this->faker->paragraphs(rand(3, 10), true),
				'created_at' => $randDate,
				'updated_at' => $randDate
			]);
		}

		echo $numberPost.' posts created';

		Model::reguard();
	}

	/**
	 * Seeding comments on posts
	 */
	public function seedComments()
	{
		//Unguard model
		Model::unguard();

		$totalGenerated = 0;

		foreach(Post::all() as $post) {
			$numComments = rand(3, 50);
			$randDate = $this->faker->dateTimeBetween('-1years', 'now');
			for($i = 0; $i < $numComments; $i++) {
				$post->comments()->create([
					'user_id' => User::orderByRaw('RAND()')->limit(1)->first()->id,
					'content' => $this->faker->paragraph(rand(1, 5)),
					'created_at' => $randDate,
					'updated_at' => $randDate,
				]);
			}
			$totalGenerated += $numComments;
		}

		echo $totalGenerated.' comments created';

		Model::reguard();
	}

	/**
	 * Seeding likes on a post
	 */
	public function seedLikesOnPosts()
	{
		//Unguard model
		Model::unguard();

		$totalGenerated = 0;

		foreach(Post::all() as $post) {
			$users = User::orderByRaw('RAND()')->limit(rand(1, 30))->get();
			//Create a new like on post by the user
			foreach($users as $user) {
				$randDate = $this->faker->dateTimeBetween('-1years', 'now');
				$post->likes()->create([
					'user_id' => $user->id,
					'created_at' => $randDate,
					'updated_at' => $randDate,
				]);
			}
			$totalGenerated += $users->count();
		}

		echo $totalGenerated.' likes created on posts';

		Model::reguard();
	}
}