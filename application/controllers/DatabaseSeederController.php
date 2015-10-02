<?php

use App\Eloquent\UomValidId;
use App\Eloquent\User;
use Illuminate\Database\Eloquent\Model;

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

}