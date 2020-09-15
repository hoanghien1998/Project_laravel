<?php

use App\Models\CarModel;
use App\Models\CarTrim;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public $max_per_user = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = $this->getUsers();

        while ($users->count() > 0) {
            dump("Process batch size " . $users->count());

            /** @var User $user */
            foreach ($users as $user) {
                $number = rand(10, $this->max_per_user);
                dump("    Generate {$number} listings for {$user->id} {$user->first_name} <{$user->email}>");

                do {
                    /** @var CarTrim $carTrim */
                    $carTrim = CarTrim::inRandomOrder()->first();

                    $factory = factory(Listing::class);
                    $factory->create([
                        Listing::CAR_MODEL_ID => $carTrim->model_id,
                        Listing::CAR_TRIM_ID => $carTrim->id,
                        Listing::CREATED_BY => $user->id,
                    ]);
                    $number--;
                } while($number > 0);
            }

            $users = $this->getUsers();
        }
    }

    /**
     * Get Users.
     *
     * @param int $limit Collection size
     *
     * @return Collection
     */
    private function getUsers($limit = 100): Collection
    {
        return User::query()
            ->whereDoesntHave(Listing::TABLE_NAME)
            ->orderByDesc(User::CREATED_AT)
            ->limit($limit)
            ->get();
    }
}
