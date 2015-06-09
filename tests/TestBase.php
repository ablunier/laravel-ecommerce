<?php
namespace ANavallaSuiza\Tests;

use Orchestra\Testbench\TestCase;
use DB;

class TestBase extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->resetDatabase();
    }

    protected function getPackageProviders($app)
    {
        return ['ANavallaSuiza\Ecommerce\StoreServiceProvider'];
    }
    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__.'/..';

        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'    => ''
        ]);
    }

    private function resetDatabase()
    {
        $migrationsPath = 'src/migrations';

        $artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');

        // Makes sure the migrations table is created
        $artisan->call('migrate', [
            '--path'     => $migrationsPath,
        ]);

        // We empty all tables
        $artisan->call('migrate:reset');

        // Migrate
        $artisan->call('migrate', [
            '--path'     => $migrationsPath,
        ]);
    }

    public function testRunningMigration()
    {
        $migrations = DB::select('SELECT * FROM migrations');

        $this->assertCount(3, $migrations);
    }
}
