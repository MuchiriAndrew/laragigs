<?php
    namespace App\Models;

    class Listing {
        public static function all() {
            return [
                ['id' => 1, 'title' => 'Listing 1', 'description' => 'lorem ipsum emet sakdkadnksad' ],
                ['id' => 2, 'title' => 'Listing 2', 'description' => 'lorem ipsum emet sakdkadnksad' ],
                ['id' => 3, 'title' => 'Listing 3', 'description' => 'lorem ipsum emet sakdkadnksad' ],
            ];
        }

        public static function find($id) {
            $listings = self::all();

            foreach ($listings as $listing) {
                if ($listing['id'] == $id) {
                    return $listing;
                }
            }
         }
    }
