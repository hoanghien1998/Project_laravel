<?php

use App\Models\Document;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public $max_per_listing = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listings = $this->getListings();
        $img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1024px-Google_2015_logo.svg.png';

        while ($listings->count() > 0) {
            $this->command->info("Process batch size " . $listings->count());

            /* @var Listing $listing */
            $listings->each(function($listing) use ($img) {
                $number = rand(3, $this->max_per_listing);
                $this->command->info("    Generate {$number} documents for {$listing->id}");

                do {
                    $factory = factory(Document::class);
                    $factory->create([
                        Document::LISTING_ID => $listing->id,
                        Document::SEQUENCE => $number,
                        Document::THUMBNAIL => $img,
                        Document::FULL => $img,
                    ]);
                    $number--;
                } while($number > 0);
            });

            $listings = $this->getListings();
        }
    }

    /**
     * Get Listing.
     *
     * @param int $limit Collection size
     *
     * @return Collection
     */
    private function getListings($limit = 100): Collection
    {
        return Listing::query()
            ->whereDoesntHave(Document::TABLE_NAME)
            ->orderByDesc(Document::CREATED_AT)
            ->limit($limit)
            ->get();
    }
}
