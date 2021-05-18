# Super simple statuses for your Laravel Models

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alejandrotrevi/laravel-ankal.svg?style=flat-square)](https://packagist.org/packages/alejandrotrevi/laravel-ankal)
[![Total Downloads](https://img.shields.io/packagist/dt/alejandrotrevi/laravel-ankal.svg?style=flat-square)](https://packagist.org/packages/alejandrotrevi/laravel-ankal)
![GitHub Actions](https://github.com/alejandrotrevi/laravel-ankal/actions/workflows/main.yml/badge.svg)

Sometimes you only need a simple way to manage statuses.

## Installation

You can install the package via composer:

```bash
composer require alejandrotrevi/laravel-ankal
```

Opcionalmente, puedes publicar la migración incluida con la librería. La migración incluida es un buen lugar para
añadir las columnas necesarias en tus tablas o tal vez remover algunas columnas de las tablas existentes.
```php
php artisan vendor:publish --provider="Alejandrotrevi\LaravelAnkal\LaravelAnkalServiceProvider" --tag="migrations"
```

## Usage

Add the ``HasStatuses`` trait to a model.
```php
use Alejandrotrevi\LaravelAnkal\HasStatuses;

class MyModel extends Model
{
    use HasStatuses;
}
```

Añade las migraciones necesarias a cada una de las tablas sobre las cuales usarás los status.
```php
Schema::create('my_table', function (Blueprint $table) {
    $table->statusColumns();
});
```
detrás de escenas esto básicamente te añade 3 columnas: ``status``, ``reason`` y ``status_updated_at``.

Opcionalmente puedes establecer un estatus por defecto para esa tabla, simplemente le pasas un argumento adicional
a ``statusColumns()`` este argumento adicional es el estatus que tendrá por defecto la tabla al crear un nuevo modelo.
```php
Schema::create('my_table', function (Blueprint $table) {
    $table->statusColumns('my_default_status');
});
```

###Set a status
You can set a new status like this:
```php
$model->setStatus('status');
```
You can also provide a reason for the status modification.
```php 
$model->setStatus('status', 'why this status changed?');
```

Since the status exist on the same table you simply call the status as another property on your model.
```php
$model->status;
$model->reason;
$model->status_updated_at;
```

###Scopes
You have 2 scopes available for your models ``currentStatus`` and ``withoutStatus``.

```php
// All models with status "status"
Model::currentStatus('status');

// All models with status "status" or "other-status"
Model::currentStatus('status', 'other-status');
Model::currentStatus(['status', 'other-status']);
```
Without a given status:
```php
// All models except those with the "status" status
Model::withoutStatus('status');

// All models except those with the "status" or "other-status" statuses.
Model::withoutStatus('status', 'other-status');
Model::withoutStatus(['status', 'other-status']);
```



### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email alex_tf_1992@live.com.mx instead of using the issue tracker.

## Credits
This package is heavily inspired in the [spatie / laravel-model-status](https://github.com/spatie/laravel-model-status) package, this aims to be
a simpler version of Spatie's solution, every credit should go to them :hugs:

-   [Alejandro](https://github.com/alejandrotrevi)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Why Ankal?

Ankal means "To be" in Mayan language.