<?php
namespace ANavallaSuiza\PhpSpec\Eloquent;

use PhpSpec\ObjectBehavior;
use Illuminate\Database\Capsule\Manager as Capsule;

class ModelBehavior extends ObjectBehavior
{
    public function let()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'    => ''
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}
