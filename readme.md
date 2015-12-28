Laravel Multi Domain
======
## Purpose

The purpose of this module is allow to use multiple domains in Laravel application.

Although this module does not handle switching domains based on current domain ([this package does](https://packagist.org/packages/mnabialek/laravel-multi-config)), it allow
to set custom directories depending on current environment so it will make possible to use separate domains and store files/logs etc. in separate folders for each domain


## Information

This module has not been tested yet. Basic testing was done for `Laravel 5.2` so if you want to use this module make sure you made backups of all your data and you really know what you are doing.

## Installation

1) Run:

`composer require `mnnabialek/laravel-multi-domain` in your console

or add:

`"mnabialek/laravel-multi-domain": "*"`

into `require` section of `composer.json`

2) Run `composer install` in console

3) Open `bootstrap/app.php` and change

`$app = new App\Core\Extended\ExtendedApplication(`

into

`$app = new Mnabialek\LaravelMultiDomain\Application(`

4) If you use [Laravel multi config](](https://packagist.org/packages/mnabialek/laravel-multi-config) (recommended) add into `config/multiconfig.php` in `bootstrappers` section the following entry:

```
'Illuminate\Foundation\Bootstrap\ConfigureLogging' => 'Mnabialek\LaravelMultiDomain\ConfigureLogging',
```

otherwise in both `app/Http/Kernel.php` and `app/Console/Kernel.php` you should declare `$bootstrappers` property (same as in parent) and replace 

`'Illuminate\Foundation\Bootstrap\ConfigureLogging'`

with

`'Mnabialek\LaravelMultiDomain\ConfigureLogging'`

 
6) Run

`php artisan vendor:publish --provider=Mnabialek\\LaravelMultiDomain\\MultiDomainServiceProvider`

to publish module configuration file.


8) Open `config/multidomain.php` and set it up according to your needs (reasonable defaults are provided)

## Configuration

By default this package modifies bootstrap directory (separate for each domain) and log directory. However that's not all you need to run as separate environment. 

For example - storage directory will be shared between all domains so in case you upload something to this directory, you should either manually put files into valid subdirectory or modify also storage_path.

By default some extra files that modify configuration files were provided. In case you use LaravelMultiConfig, you can run php `artisan multi:change-paths` and extra configuration files will be put by default in `config/custom` directory (you can of course change it using ---directory parameter). However in case you don't use mentioned module, you will need to alter main config files by yourself - run `php artisan multi:change-paths --show-only` to display suggested changes that should be made in Laravel configuration files (you should merge those changes with default Laravel configuration files and not override the whole files with displayed content) 



### Licence

This package is licenced under the [MIT license](http://opensource.org/licenses/MIT)
