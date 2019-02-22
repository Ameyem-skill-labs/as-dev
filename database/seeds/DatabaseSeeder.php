<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     Model::unguard();
    //     $this->call(NatureInoutSeeder::class);
    //     // $this->call(PermissionsTableSeeder::class);
    //     // $this->call(RolesTableSeeder::class);
    //     // $this->call(ConnectRelationshipsSeeder::class);
    //     // $this->call(ThemesTableSeeder::class);
    //     // $this->call(UsersTableSeeder::class);
    //     // $this->call(TutappSeeder::class);
        

    //     Model::reguard();
    // }

    public function run()
    {
        /* Creating initial user instances of 3 */

        /* create a student instance */
        DB::table('natureinout')->insert(['nature' => 'upon joining', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(),]);
        DB::table('natureinout')->insert(['nature' => 'enrolling course', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);
        DB::table('natureinout')->insert(['nature' => 'as course creator', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);
        DB::table('natureinout')->insert(['nature' => 'as guide', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);
        DB::table('natureinout')->insert(['nature' => 'as reviewer', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);
        DB::table('natureinout')->insert(['nature' => 'as student' , 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(),]);
        DB::table('natureinout')->insert(['nature' => 'as company representative', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);
        DB::table('natureinout')->insert(['nature' => 'sharing link', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);
        DB::table('natureinout')->insert(['nature' => 'for referring friend', 
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(), ]);

    }
}
