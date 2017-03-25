# Log Manager
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/28c7bcb0b5d2451783990e0a151f0a44)](https://www.codacy.com/app/laravel-enso/LogManager?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/LogManager&amp;utm_campaign=Badge_Grade)

Library for LaravelEnso's logs management

# Don't forget to

php artisan vendor:publish --tag=logmanager-migration
php artisan vendor:publish --tag=logmanager-config
php artisan vendor:publish --tag=logmanager-views
php artisan vendor:publish --tag=logmanager-notification

php artisan migrate

add the desired email list in config/logmanager.php file

include the js assets in you app.js, then run gulp

add the following to app/Console/Kernel.php schedule method in order to receive regular email notifications.
>>>
$schedule->call(function () {

    $logReporting = new LogReporting;
    $logReporting->checkLaravelLog();
})->everyTenMinutes();
>>>

## Upgrade from laravel-enso v2

Correct the includes
