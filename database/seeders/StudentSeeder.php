<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'nim'     => '2024001',
                'nama'    => 'Ahmad Fauzi',
                'jurusan' => 'Teknik Informatika',
                'email'   => 'ahmad.fauzi@mail.com',
                'no_hp'   => '081234567890',
            ],
            [
                'nim'     => '2024002',
                'nama'    => 'Siti Nurhaliza',
                'jurusan' => 'Sistem Informasi',
                'email'   => 'siti.nurhaliza@mail.com',
                'no_hp'   => '082345678901',
            ],
            [
                'nim'     => '2024003',
                'nama'    => 'Budi Santoso',
                'jurusan' => 'Teknik Informatika',
                'email'   => 'budi.santoso@mail.com',
                'no_hp'   => '083456789012',
            ],
            [
                'nim'     => '2024004',
                'nama'    => 'Dewi Lestari',
                'jurusan' => 'Manajemen Informatika',
                'email'   => 'dewi.lestari@mail.com',
                'no_hp'   => '084567890123',
            ],
            [
                'nim'     => '2024005',
                'nama'    => 'Rizky Pratama',
                'jurusan' => 'Teknik Komputer',
                'email'   => 'rizky.pratama@mail.com',
                'no_hp'   => '085678901234',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
