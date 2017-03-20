# Log Manager

Library for LaravelEnso logs management

# Don't forget to

artisan vendor:publish --tag=logmanager-migrations
artisan vendor:publish --tag=logmanager-config
artisan vendor:publish --tag=logmanager-resources

php artisan migrate

include the js assets in you app.js, then run gulp

## Upgrade from laravel-enso v2

Correct the includes
