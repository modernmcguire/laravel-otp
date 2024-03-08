<?php

namespace ModernMcGuire\Drawbridge\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use ModernMcGuire\Drawbridge\DrawbridgeServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'ModernMcGuire\\Drawbridge\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DrawbridgeServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_drawbridge_table.php.stub';
        $migration->up();
        */
    }
}
