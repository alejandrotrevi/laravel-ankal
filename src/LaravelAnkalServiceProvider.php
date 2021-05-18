<?php

namespace Alejandrotrevi\LaravelAnkal;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class LaravelAnkalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Blueprint::macro('statusColumns', function($defaultStatus = 'default') {
            $this->string('status')->default($defaultStatus);
            $this->text('reason')->nullable();
            $this->timestamp('status_updated_at')->nullable();
        });

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateStatusColumns')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_status_columns.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_status_columns.php'),
                ], 'migrations');
            }
        }
    }
}
