<?php

namespace Alejandrotrevi\LaravelAnkal\Tests;

use Alejandrotrevi\LaravelAnkal\LaravelAnkalServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        tap($this->app['db']->connection()->getSchemaBuilder(), function ($schema) {
            $schema->create('test_models', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->statusColumns();

                $table->timestamps();
            });
        });
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelAnkalServiceProvider::class,
        ];
    }
}