# Laravel Thailand Provinces
Thailand provinces data for Laravel

[![Latest Stable Version](https://poser.pugx.org/tienrocker/thailand-provinces/v/stable)](https://packagist.org/packages/tienrocker/thailand-provinces)
[![Total Downloads](https://poser.pugx.org/tienrocker/thailand-provinces/downloads)](https://packagist.org/packages/tienrocker/thailand-provinces)
[![Latest Unstable Version](https://poser.pugx.org/tienrocker/thailand-provinces/v/unstable)](https://packagist.org/packages/tienrocker/thailand-provinces)
[![License](https://poser.pugx.org/tienrocker/thailand-provinces/license)](https://packagist.org/packages/tienrocker/thailand-provinces)

# Thailand provinces database
This database was taken from https://github.com/parsilver/thailand-provinces-php.

## Installation

Add `tienrocker/thailand-provinces` to `composer.json`.

    "tienrocker/thailand-countries": "dev-master"
    
Run `composer update` to pull down the latest version of Provinces List.

Edit `app/config/app.php` and add the `provider` and `alias`

    'providers' => [
        'Tienrocker\ThProvinces\ProvincesServiceProvider',
    ]

Now add the alias.

    'aliases' => [
        'ThProvinces' => 'Tienrocker\ThProvinces\Provinces\Facades\Provinces',
    ]

## Model (Data)    
You can start by publishing the configuration. This is an optional step, it contains the table name and does not need to be altered. If the default name `provinces` suits you, leave it. Otherwise run the following command

    $ php artisan vendor:publish --tag=thprovinces

Next generate the migration file:

    $ php artisan thprovinces:migration
    
It will generate the `<timestamp>_create_provinces_table.php` migration and the `ProvincesSeeder.php` seeder. To make sure the data is seeded insert the following code in the `seeds/DatabaseSeeder.php`

    //Seed the provinces
    $this->call('ProvincesSeeder');
    $this->command->info('Seeded Thailand provinces!'); 

You can also run `php artisan db:seed --class=ProvincesSeeder` instead of adding those commands in `seeds/DatabaseSeeder.php`

You may now run it with the artisan migrate command:

    $ php artisan migrate --seed
    
After running this command the filled provinces table will be available for usage in your application.
