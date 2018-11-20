<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('welcome:message_simple', function () {
    $this->info('欢迎访问 Laravel 学院!');
})->describe('打印欢迎信息');

Artisan::command('welcome:output_table', function () {
    $headers = ['姓名', '城市'];
    $data = [
        ['张三', '北京'],
        ['李四', '上海']
    ];
    $this->table($headers, $data);
})->describe('打印图表');

Artisan::command('welcome:progress_bar', function () {
    $totalUnits = 10;
    $this->output->progressStart($totalUnits);

    $i = 0;
    while ($i++ < $totalUnits) {
        sleep(1);
        $this->output->progressAdvance();
    }

    $this->output->progressFinish();
})->describe('打印图表');