# Log Manager

Library for LaravelEnso's logs management

# Don't forget to

php artisan vendor:publish --tag=logmanager-migrations
php artisan vendor:publish --tag=logmanager-config
php artisan vendor:publish --tag=logmanager-resources

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
