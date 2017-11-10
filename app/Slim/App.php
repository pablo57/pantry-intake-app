<?php
declare(strict_types=1);

namespace pantry;

use DI\Bridge\Slim\App as BridgeApp;
use DI\ContainerBuilder;
use Illuminate\Database\Capsule\Manager as Capsule;

use pantry\Household\HouseholdController;

class App extends BridgeApp
{
    protected $capsule;

    public function __construct()
    {
        parent::__construct();

        $container = $this->getContainer();

        $this->capsule = $container->get(Capsule::class);

        $v1 = $this->group('/v1', function () use ($container)
        {
            $container->get(HouseholdController::class)->register($this);
        });

        // TODO
        // $v1->add('authClass');
    }

    protected function configureContainer(ContainerBuilder $builder) //: void
    {
        assert(func_num_args() === 1);

        include_once(__DIR__ . '/../../config/_env.php');
        foreach (glob(__DIR__ . '/../../config/*.php') as $definitions) {
            if (strpos($definitions, '_env.php') === false) {
                $builder->addDefinitions(realpath($definitions));
            }
        }
    }
}