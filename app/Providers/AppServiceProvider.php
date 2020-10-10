<?php

namespace App\Providers;

use Carbon\Carbon;
use Cmixin\BusinessDay;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $baseList = 'id-national';

        // $additionalHolidays = [
        //     'tahun-baru-masehi' => '01-01', //Tahun Baru Masehi
        //     'tahun-baru-imlek' => '01-25', //Tahun Baru Imlek 2571
        //     'isra-mikraj' => '03-22', //Isra Mikraj Nabi Muhammad SAW
        //     'hari-nyepi' => '03-25', //Hari Suci Nyepi Tahun Baru Saka 1942
        //     'wafat-isa' => '04-10', //Wafat Isa Al Masih
        //     'hari-buruh' => '05-01', //Hari Buruh Internasional
        //     'hari-waisak' => '05-07', //Hari Raya Waisak 2564
        //     'kenaikan-isa' => '05-21', //Kenaikan Isa Al Masih
        //     'hari-pancasila' => '06-01', //Hari Lahir Pancasila
        //     'hari-idul-adha' => '07-31', //Hari Raya Idul Adha 1441 Hijriyah
        //     'hari-kemerdekaan' => '08-17', //Hari Kemerdekaan RI
        //     'maulid-nabi' => '10-29', //Maulid Nabi Muhammad SAW
        //     'hari-raya-natal' => '12-25', //Hari Raya Natal
        // ];


        BusinessDay::enable('Illuminate\Support\Carbon');
        // BusinessDay::enable('Illuminate\Support\Carbon', $baseList, $additionalHolidays);
        // Carbon::setHolidayName('tahun-baru-masehi', 'en', 'Tahun Baru Masehi');
        // Carbon::setHolidayName('tahun-baru-imlek', 'en', 'Tahun Baru Imlek');
        // Carbon::setHolidayName('isra-mikraj', 'en', 'Isra Miraj');
        // Carbon::setHolidayName('hari-nyepi', 'en', 'Hari Raya Nyepi');
        // Carbon::setHolidayName('wafat-isa', 'en', 'Wafat Isa Almasih');
        // Carbon::setHolidayName('hari-buruh', 'en', 'Hari Buruh');
        // Carbon::setHolidayName('hari-waisak', 'en', 'Hari Raya Waisak');
        // Carbon::setHolidayName('kenaikan-isa', 'en', 'Kenaikan Isa Almasih');
        // Carbon::setHolidayName('hari-pancasila', 'en', 'Hari Lahir Pancasila');
        // Carbon::setHolidayName('hari-idul-adha', 'en', 'Hari Raya Idul Adha');
        // Carbon::setHolidayName('hari-kemerdekaan', 'en', 'Hari Kemerdekaan Indonesia');
        // Carbon::setHolidayName('maulid-nabi', 'en', 'Maulid Nabi');
        // Carbon::setHolidayName('hari-raya-natal', 'en', 'Hari Raya Natal');
    }
}
