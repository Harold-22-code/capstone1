<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\facades\Hash;

	use App\Models\Role;
	use App\Models\User;

	use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        // this will remove the record from the table when performing seeder 
        User::truncate();
        DB::table('role_user')->truncate();
        
        // ths will get the roles from the role table 
        $parish_priestRole = Role::Where('name', 'parish_priest')->first();  
        $secretaryRole = Role::Where('name', 'secretary')->first();

        // this will define the users credentials and adds to the table users 
        $parish_priest = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin')
        ]);

      

        $secretary = User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('user')
        ]);

           




        // this will attach the roles to the user account 
        $parish_priest->roles()->attach($parish_priestRole);
        $secretary->roles()->attach($secretaryRole);


   
    }
}
