# Generate slugs when saving Eloquent models

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alhaji-aki/laravel-uuid.svg?style=flat-square)](https://packagist.org/packages/alhaji-aki/laravel-uuid)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/alhaji-aki/laravel-uuid/run-tests?label=tests)](https://github.com/alhaji-aki/laravel-uuid/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/alhaji-aki/laravel-uuid.svg?style=flat-square)](https://packagist.org/packages/alhaji-aki/laravel-uuid)

This package provides a trait that will generate a unique uuid when saving any Eloquent model.

```php
$model = new EloquentModel();
$model->name = 'activerecord is awesome';
$model->save();
echo $model->uuid; // outputs a uuid
```

## Installation

You can install the package via composer:

```bash
composer require alhaji-aki/laravel-uuid
```

## Usage

Your Eloquent models should use the `AlhajiAki\LaravelUuid\HasUuid` trait.

The trait contains an abstract method `getUuidColumn()` that you must implement yourself.

Your models' migrations should have a field to save the uuid to.

Here's an example of how to implement the trait:

```php
namespace App;
use AlhajiAki\LaravelUuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
class YourEloquentModel extends Model
{
    use HasUuid;

    /**
     * Get the column to save the generated uuid to.
     */
    public function getUuidColumn() : string
    {
        return 'uuid';
    }
}
```

With its migration:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateYourEloquentModelTable extends Migration
{
    public function up()
    {
        Schema::create('your_eloquent_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid'); // Field name same as what you return in `getUuidColumn`
            $table->string('name');
            $table->timestamps();
        });
    }
}
```

### Using slugs in routes

To use the generated uuid in routes, remember to use Laravel's [implicit route model binding](https://laravel.com/docs/8.x/routing#implicit-binding):

```php
namespace App;
use AlhajiAki\LaravelUuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
class YourEloquentModel extends Model
{
    use HasUuid;

    /**
     * Get the column to save the generated uuid to.
     */
    public function getUuidColumn() : string
    {
        return 'uuid';
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
```

### Overriding slugs

You can also override the generated slug just by setting it to another value than the generated slug.

```php
$model = EloquentModel::create(['name' => 'my name']); //slug is now "my-name";
$model->slug = 'my-custom-url';
$model->save(); //slug is now "my-custom-url";
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email abdulkudus2922@gmail.com instead of using the issue tracker.

## Credits

This package is inspired by [Spatie Laravel Sluggable](https://github.com/spatie/laravel-sluggable).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
