<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{User, Service, Doctor, Schedule, Article, Education, Category, Announcement, Banner, Contact};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================
        // USERS
        // ============================
        $admin = User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@rsmedika.com',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name'              => 'Budi Santoso',
            'email'             => 'user@rsmedika.com',
            'password'          => Hash::make('password'),
            'role'              => 'user',
            'phone'             => '08123456789',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);

        // ============================
        // CATEGORIES
        // ============================
        $catBerita   = Category::create(['name' => 'Berita Rumah Sakit', 'slug' => 'berita-rs',       'type' => 'article']);
        $catKegiatan = Category::create(['name' => 'Kegiatan',           'slug' => 'kegiatan',          'type' => 'article']);
        $catEduInfo  = Category::create(['name' => 'Informasi Kesehatan','slug' => 'informasi-kesehatan','type' => 'education']);
        $catTips     = Category::create(['name' => 'Tips Kesehatan',     'slug' => 'tips-kesehatan',    'type' => 'education']);

        // ============================
        // ANNOUNCEMENTS
        // ============================
        Announcement::create(['title'=>'Jadwal Libur Nasional','content'=>'Poliklinik tetap beroperasi pada hari libur nasional dengan jadwal terbatas. IGD tetap 24 jam.','type'=>'info','is_active'=>true]);
        Announcement::create(['title'=>'Vaksinasi Gratis','content'=>'Program vaksinasi gratis tersedia setiap Rabu pukul 09.00-12.00 WIB di Poli Imunisasi.','type'=>'success','is_active'=>true]);

        // ============================
        // SERVICES
        // ============================
        $services = [
            ['name'=>'Instalasi Gawat Darurat','short_description'=>'Layanan darurat 24 jam dengan tim medis siap siaga untuk penanganan kondisi kritis.','icon'=>'🚨','category'=>'Darurat','sort_order'=>1],
            ['name'=>'Rawat Inap','short_description'=>'Fasilitas rawat inap nyaman dengan kamar berbagai kelas, dilengkapi perawat berpengalaman.','icon'=>'🛏️','category'=>'Rawat Inap','sort_order'=>2],
            ['name'=>'Poli Umum','short_description'=>'Konsultasi kesehatan umum dengan dokter umum berpengalaman setiap hari kerja.','icon'=>'🩺','category'=>'Poliklinik','sort_order'=>3],
            ['name'=>'Poli Jantung','short_description'=>'Penanganan komprehensif penyakit kardiovaskular oleh spesialis jantung bersertifikat.','icon'=>'❤️','category'=>'Poliklinik','sort_order'=>4],
            ['name'=>'Poli Anak','short_description'=>'Layanan kesehatan anak dari bayi hingga remaja oleh dokter spesialis anak.','icon'=>'👶','category'=>'Poliklinik','sort_order'=>5],
            ['name'=>'Poli Kandungan','short_description'=>'Perawatan lengkap ibu hamil dan kesehatan reproduksi wanita oleh dokter spesialis.','icon'=>'🤰','category'=>'Poliklinik','sort_order'=>6],
            ['name'=>'Laboratorium','short_description'=>'Pemeriksaan laboratorium lengkap dengan peralatan modern dan hasil akurat.','icon'=>'🔬','category'=>'Penunjang','sort_order'=>7],
            ['name'=>'Radiologi','short_description'=>'Layanan X-Ray, USG, CT-Scan, dan MRI dengan teknisi radiologi berpengalaman.','icon'=>'📡','category'=>'Penunjang','sort_order'=>8],
            ['name'=>'Farmasi','short_description'=>'Apotek 24 jam dengan ketersediaan obat lengkap dan konsultasi apoteker.','icon'=>'💊','category'=>'Penunjang','sort_order'=>9],
            ['name'=>'Fisioterapi','short_description'=>'Program rehabilitasi dan fisioterapi untuk pemulihan optimal pasca cedera.','icon'=>'🏃','category'=>'Rehabilitasi','sort_order'=>10],
        ];

        $serviceModels = [];
        foreach ($services as $s) {
            $serviceModels[$s['name']] = Service::create(array_merge($s, ['slug' => Str::slug($s['name']).'-'.Str::random(4), 'description' => 'Deskripsi lengkap layanan '.$s['name'].' di RS Medika Nusantara.', 'is_active' => true]));
        }

        // ============================
        // DOCTORS
        // ============================
        $doctors = [
            ['name'=>'Ahmad Fauzi','specialization'=>'Dokter Spesialis Jantung','service'=>'Poli Jantung','education'=>'FK UI, Sp.JP - Kardiologi'],
            ['name'=>'Siti Rahma','specialization'=>'Dokter Spesialis Anak','service'=>'Poli Anak','education'=>'FK UGM, Sp.A - Ilmu Kesehatan Anak'],
            ['name'=>'Budi Hartono','specialization'=>'Dokter Spesialis Kandungan','service'=>'Poli Kandungan','education'=>'FK UNPAD, Sp.OG'],
            ['name'=>'Dewi Sartika','specialization'=>'Dokter Umum','service'=>'Poli Umum','education'=>'FK UNDIP'],
            ['name'=>'Rizky Pratama','specialization'=>'Dokter Spesialis Bedah','service'=>'Instalasi Gawat Darurat','education'=>'FK UI, Sp.B'],
            ['name'=>'Maya Indah','specialization'=>'Dokter Spesialis Saraf','service'=>'Poli Umum','education'=>'FK UNS, Sp.S - Neurologi'],
        ];

        $doctorModels = [];
        foreach ($doctors as $d) {
            $svc = $serviceModels[$d['service']] ?? null;
            $doc = Doctor::create([
                'name'           => $d['name'],
                'slug'           => Str::slug($d['name']).'-'.Str::random(4),
                'specialization' => $d['specialization'],
                'education'      => $d['education'],
                'bio'            => 'dr. '.$d['name'].' adalah dokter berpengalaman yang telah melayani pasien selama lebih dari 10 tahun.',
                'service_id'     => $svc?->id,
                'is_active'      => true,
            ]);
            $doctorModels[] = ['model' => $doc, 'service' => $svc];
        }

        // ============================
        // SCHEDULES
        // ============================
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        foreach ($doctorModels as $i => $dm) {
            $assignedDays = array_slice($days, $i % 3, 3);
            foreach ($assignedDays as $day) {
                Schedule::create([
                    'doctor_id'  => $dm['model']->id,
                    'service_id' => $dm['service']?->id,
                    'day'        => $day,
                    'time_start' => '08:00:00',
                    'time_end'   => '12:00:00',
                    'room'       => 'Poli '.($i + 1),
                    'quota'      => 20,
                    'is_active'  => true,
                ]);
            }
        }

        // ============================
        // ARTICLES
        // ============================
        $articleData = [
            ['title'=>'RS Medika Nusantara Raih Akreditasi Paripurna Kembali','excerpt'=>'Pengakuan tertinggi KARS kembali diraih untuk kelima kalinya berturut-turut.','type'=>'news','cat'=>$catBerita],
            ['title'=>'Program Vaksinasi Gratis untuk Masyarakat Sekitar','excerpt'=>'Dalam rangka HUT RS, kami membuka program vaksinasi gratis untuk masyarakat.','type'=>'news','cat'=>$catKegiatan],
            ['title'=>'Pengumuman: Penambahan Layanan MRI 3 Tesla','excerpt'=>'Mulai bulan ini, RS Medika Nusantara hadir dengan layanan MRI terbaru.','type'=>'announcement','cat'=>$catBerita],
            ['title'=>'Seminar Kesehatan Jantung Bersama Prof. Dr. Ahmad','excerpt'=>'Seminar kesehatan jantung gratis terbuka untuk umum, sabtu 10 Februari 2024.','type'=>'news','cat'=>$catKegiatan],
        ];

        foreach ($articleData as $a) {
            Article::create([
                'user_id'      => $admin->id,
                'category_id'  => $a['cat']->id,
                'title'        => $a['title'],
                'slug'         => Str::slug($a['title']).'-'.Str::random(5),
                'excerpt'      => $a['excerpt'],
                'content'      => '<p>'.str_repeat('Ini adalah konten contoh artikel. RS Medika Nusantara berkomitmen untuk memberikan informasi kesehatan yang bermanfaat bagi masyarakat. ', 5).'</p><p>Kami terus berinovasi dan meningkatkan kualitas layanan demi kepuasan pasien.</p>',
                'type'         => $a['type'],
                'status'       => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views'        => rand(50, 500),
            ]);
        }

        // ============================
        // EDUCATIONS
        // ============================
        $eduData = [
            ['title'=>'7 Tips Menjaga Kesehatan Jantung di Usia 40-an','type'=>'article','cat'=>$catTips,'excerpt'=>'Penyakit jantung masih menjadi penyebab kematian tertinggi. Simak tipsnya.'],
            ['title'=>'Cara Mencuci Tangan yang Benar Menurut WHO','type'=>'video','cat'=>$catEduInfo,'excerpt'=>'Video panduan mencuci tangan 6 langkah sesuai standar WHO untuk cegah infeksi.','video_url'=>'https://www.youtube.com/embed/3PmVJQUCm4E'],
            ['title'=>'Mengenal Diabetes: Gejala, Penyebab, dan Pencegahan','type'=>'article','cat'=>$catEduInfo,'excerpt'=>'Informasi lengkap seputar diabetes mellitus yang perlu Anda ketahui.'],
            ['title'=>'Panduan MPASI untuk Bayi 6 Bulan','type'=>'article','cat'=>$catTips,'excerpt'=>'Panduan lengkap pemberian makanan pendamping ASI yang tepat dan bergizi.'],
        ];

        foreach ($eduData as $e) {
            Education::create([
                'user_id'      => $admin->id,
                'category_id'  => $e['cat']->id,
                'title'        => $e['title'],
                'slug'         => Str::slug($e['title']).'-'.Str::random(5),
                'excerpt'      => $e['excerpt'],
                'content'      => '<p>'.str_repeat('Ini adalah konten edukasi kesehatan yang informatif. ', 8).'</p>',
                'video_url'    => $e['video_url'] ?? null,
                'type'         => $e['type'],
                'status'       => 'published',
                'published_at' => now()->subDays(rand(1, 20)),
                'views'        => rand(100, 1000),
            ]);
        }

        // ============================
        // CONTACTS
        // ============================
        Contact::create(['name'=>'Siti Nurhaliza','email'=>'siti@email.com','phone'=>'08111222333','subject'=>'Pertanyaan Jadwal Dokter','message'=>'Selamat pagi, saya ingin bertanya tentang jadwal dokter spesialis anak dr. Siti Rahma. Apakah buka pada hari Sabtu?','status'=>'unread']);
        Contact::create(['name'=>'Andi Pratama','email'=>'andi@email.com','phone'=>'08222333444','subject'=>'Kritik Pelayanan','message'=>'Saya ingin memberikan masukan terkait pelayanan di loket pendaftaran yang antrenya sangat panjang.','status'=>'read']);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Admin: admin@rsmedika.com / password');
        $this->command->info('📧 User:  user@rsmedika.com / password');
    }
}
