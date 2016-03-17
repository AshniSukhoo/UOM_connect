<?php

use App\Eloquent\UomValidId;
use App\Eloquent\User;
use App\Eloquent\Post;
use App\Eloquent\Comment;
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
				'content' => $this->faker->paragraphs(mt_rand(3, 10), true),
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
			$numComments = mt_rand(3, 50);
			$randDate = $this->faker->dateTimeBetween('-1years', 'now');
			for($i = 0; $i < $numComments; $i++) {
				$post->comments()->create([
					'user_id' => User::orderByRaw('RAND()')->limit(1)->first()->id,
					'content' => $this->faker->paragraph(mt_rand(1, 5)),
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
			$users = User::orderByRaw('RAND()')->limit(mt_rand(1, 30))->get();
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

	/**
	 * Seeding likes on comments
	 */
	public function seedLikesOnComments()
	{
		//Unguard model
		Model::unguard();

		$totalGenerated = 0;

		foreach(Comment::orderBYRaw('RAND()')->limit(100)->get() as $comment) {
			$users = User::orderByRaw('RAND()')->limit(mt_rand(1, 30))->get();
			//Create a new like on post by the user
			foreach($users as $user) {
				$randDate = $this->faker->dateTimeBetween('-1years', 'now');
				$comment->likes()->create([
					'user_id' => $user->id,
					'created_at' => $randDate,
					'updated_at' => $randDate,
				]);
			}
			$totalGenerated += $users->count();
		}

		echo $totalGenerated.' likes created on comments';

		Model::reguard();
	}

    /**
     * Seeding friends for a user
     */
	public function seedFriends($userId = '')
    {
        //Unguard model
        Model::unguard();

        $totalGenerated = mt_rand(30, 100);

        $currentUser = User::findOrFail($userId);

        $users = User::where('id', '!=', $userId)->orderBYRaw('RAND()')->limit($totalGenerated)->get();

        foreach($users as $user) {
            //Make users friends
            $user->friends()->attach($currentUser->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $currentUser->friends()->attach($user->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        echo $totalGenerated.' friends generated for '.$currentUser->full_name;

        Model::reguard();
    }

	/**
	 * Seed student and lecturers faculties and courses
	 */
	public function seedCoursesAndFaculties()
    {
        //Unguard model
        Model::unguard();

        $validIds = \App\Eloquent\UomValidId::all();

        foreach($validIds as $uomId) {
            $randomFaculty = \App\Eloquent\Faculty::orderByRaw('RAND()')->limit(1)->first();
            $course = $randomFaculty->courses()->orderByRaw('RAND()')->limit(1)->first();

            $uomId->faculties()->attach($randomFaculty->id, [
                'course_id' => $course->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        echo 'Database seeded !!';

        Model::reguard();
    }

    /**
     * Seed the notifications table for a given user
     *
     * @param string $userId
     */
    public function seedNotifications($userId)
    {
        //Unguard model
        Model::unguard();

        //Get the user
        $user = \App\Eloquent\User::findOrFail($userId);
        //Seed notifications
        for ($i = 0; $i < mt_rand(10, 100); $i++) {
            //Get a random user
            $notifier = \App\Eloquent\User::where('id', '!=', $userId)->orderByRaw('RAND()')->limit(1)->first();
            //Create the notification
            $notif = $this->faker->randomElement([
                ['content' => 'accepted your friend request', 'url' => $notifier->base_profile_uri, 'type' => 'friended'],
                ['content' => 'likes your post', 'url' => $user->base_profile_uri.'/posts/'.$this->faker->randomDigit, 'type' => 'like'],
                ['content' => 'likes your comment', 'url' => $user->base_profile_uri.'/posts/'.$this->faker->randomDigit, 'type' => 'like'],
                ['content' => 'commented on your post', 'url' => $user->base_profile_uri.'/posts/'.$this->faker->randomDigit, 'type' => 'comment'],
            ]);
            //Create notification for sender
            $user->receivedNotifications()->create([
                'notifier' => $notifier->id,
                'content' => $notif['content'],
                'url' => $notif['url'],
                'notified' => false,
                'type' => $notif['type']
            ]);
        }

        Model::reguard();
    }

    /**
     * Seed invitations for a user
     *
     * @param string $userId
     */
    public function seedInvitations($userId = '')
    {
        //Unguard model
        Model::unguard();

        $numRequestToSend = mt_rand(10, 100);

        //Get the user
        $user = \App\Eloquent\User::findOrFail($userId);
        //Get number of users accordingly
        $users = \App\Eloquent\User::where('id', '!=', $userId)->orderByRaw('RAND()')->limit($numRequestToSend)->get();

        //Seed friend request
        foreach ($users as $someUser) {
            //Create friend request for user
            $user->receivedFriendRequests()->create([
                'sender' => $someUser->id,
                'notified' => false,
            ]);
        }
        echo $numRequestToSend.' requests created';
        Model::reguard();
    }
}
