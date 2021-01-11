<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepositoryEloquent;

class UsersDefaultSeeder extends Seeder
{

    /**
     * @var UserRepositoryEloquent
     */
    protected $repository;

    public function __construct(UserRepositoryEloquent $repository){
        $this->repository = $repository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name'=>  'Admin',
                'last_name' =>  'Admin',
                'email'     =>  'admin@admin.com',
                'password'  =>  'admin'
            ]

        ];

        foreach( $users as $data )
        {
            $user = $this->repository->create( $data );
            $user->assignRole('Administrador');
        }
    }
}
