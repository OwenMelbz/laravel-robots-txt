# Laravel 5 robots.txt helper with meta blade directive

An automatically generated robots.txt which automatically discourages indexing of folders, with additional meta tag blade directives for in page exclusions.


## Usage

1. Install via composer `composer require owenmelbz/laravel-robots-txt`

2. Register the service provider - typically done inside the `app.php` providers array e.g `OwenMelbz\RobotsTxt\RobotsTxtServiceProvider::class`

3. Add `BLOCK_ROBOTS=true` to your application environment config e.g `.env`

## Configuration

If you publish the package via `php artisan vendor:publish --provider="OwenMelbz\RobotsTxt\RobotsTxtServiceProvider"` you can use a custom robots.txt template file to include extra rules.
