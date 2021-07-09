<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Fatwa Amri',
                'pusat_id' => 1,
                'level' => 3,
                'username' => 'fatwaamri',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Robi Saputra',
                'pusat_id' => 10,
                'level' => 3,
                'username' => 'robisaputra',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Sri Pujiyanti',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'sripujiyanti',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Irsyam Sigit Wibowo',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'irsyamsigitwibowo',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Denny Chrisnata',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'dennychrisnata',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Pratikno',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'pratikno',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Yuono Tartousodo',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'yuonotartousodo',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Vita Ardiani',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'vitaardiani',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Hari Rachmadi',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'harirachmadi',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Rina Ismawati',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'rinaismawati',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Joko Paromo',
                'pusat_id' => 14,
                'level' => 3,
                'username' => 'jokoparomo',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Mutia Amana Nastiti, SE',
                'pusat_id' => 19,
                'level' => 3,
                'username' => 'mutiaamana',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Muhammad Bazqoni',
                'pusat_id' => 19,
                'level' => 3,
                'username' => 'mbazqoni',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Feryzal',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'feryzal',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Ahmad Ziadi',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'ahmadziadi',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Cahyadi Pratama',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'cahyadipratama',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Zakaria',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'zakaria',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Andi Nila Nandani',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'andinila',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Irwan Hadi',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'irwanhadi',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Fay Hajri',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'fayhajri',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Agus Haryanto',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'agusharyanto',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Sabri',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'sabri',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Leja Kodi, SE.',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'lejakodi',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Marianto',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'marianto',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Ahmad Muqorrobin Huda Tumbuan',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'ahmadmuqorrobin',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Ade Devi Handayani',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'adedevi',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Agus Endang Kurniawan',
                'pusat_id' => 28,
                'level' => 3,
                'username' => 'agusendang',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Ashaima N. Sharief',
                'pusat_id' => 22,
                'level' => 3,
                'username' => 'ashaima',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Jefy Rompis',
                'pusat_id' => 22,
                'level' => 3,
                'username' => 'jefryrompis',
                'password' => Hash::make('12345')
            ],
        ];
        collect($data)->each(fn($user) => User::create($user));
    }
}
