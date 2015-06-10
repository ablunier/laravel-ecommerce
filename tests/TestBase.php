<?php
namespace ANavallaSuiza\Tests;

use Orchestra\Testbench\TestCase;
use DB;

class TestBase extends TestCase
{
    const MIGRATIONS_PATH = 'migrations';

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
        $artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');

        // Makes sure the migrations table is created
        $artisan->call('migrate', [
            '--path'     => self::MIGRATIONS_PATH,
        ]);

        // We empty all tables
        $artisan->call('migrate:reset');

        // Migrate
        $artisan->call('migrate', [
            '--path'     => self::MIGRATIONS_PATH,
        ]);
    }

    public function test_running_migration()
    {
        $migrations = DB::select('SELECT * FROM migrations');

        $fi = new \FilesystemIterator(self::MIGRATIONS_PATH, \FilesystemIterator::SKIP_DOTS);

        $this->assertCount(iterator_count($fi), $migrations);
    }
}
