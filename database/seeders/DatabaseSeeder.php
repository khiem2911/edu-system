<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Bóng đá',
            'description' =>'Trò chơi đồng đội',
            'photo' => 'bongda.png',
            'start_at' =>'2023-07-07'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Bóng rổ',
            'description' =>'Trò chơi đồng đội',
            'photo' => 'bongro.png',
            'start_at' =>'2023-07-12'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Bóng chuyền',
            'description' =>'Trò chơi đồng đội',
            'photo' => 'bongchuyen.png',
            'start_at' =>'2023-07-02'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Bóng bàn',
            'description' =>'Trò chơi 1-1',
            'photo' => 'bongban.png',
            'start_at' =>'2023-07-14'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Cầu lông',
            'description' =>'Trò chơi 1-1',
            'photo' => 'caulong.png',
            'start_at' =>'2023-07-10'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Giải toán',
            'description' =>'Giải các bài toán được đưa ra từ dễ tới khó',
            'photo' => 'giaitoan.png',
            'start_at' =>'2023-06-10'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Du lịch',
            'description' =>'Nâng cao sự hiểu biết',
            'photo' => 'dulich.png',
            'start_at' =>'2023-06-22'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Ca hát',
            'description' =>'Thể hiện tài năng',
            'photo' => 'cahat.png',
            'start_at' =>'2023-07-01'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Nhảy múa',
            'description' =>'Hoạt động hay',
            'photo' => 'nhaymua.png',
            'start_at' =>'2023-07-10'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Chạy đua',
            'description' =>'Trò chơi 1-1',
            'photo' => 'chaydua.png',
            'start_at' =>'2023-06-15'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Đấu kiếm',
            'description' =>'Trò chơi 1-1',
            'photo' => 'daukiem.png',
            'start_at' =>'2023-06-30'
        ]);
        DB::table('extracurriculars')->insert([
            'name' => 'Giải đố',
            'description' =>'Vận dụng trí não',
            'photo' => 'giaido.png',
            'start_at' =>'2023-07-17'
        ]);
    }
}
