<?php
declare(strict_types=1);

namespace pantry\Intake;

use pantry\App;

class IntakeController
{
    public function register(App $slim)
    {
        $slim->get('/intakes[/{id}]', IntakeGetAction::class);
        $slim->post('/intakes', IntakePostAction::class);
        $slim->patch('/intakes', IntakePatchAction::class);
    }
}
