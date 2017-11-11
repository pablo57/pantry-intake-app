<?php
declare(strict_types=1);

namespace pantry\Household;

use pantry\App;

class HouseholdController
{
    public function register(App $slim)
    {
        $slim->get('/households[/{id}]', HouseholdGetAction::class);
        $slim->post('/households', HouseholdPostAction::class);
        $slim->patch('/households', HouseholdPatchAction::class);
    }
}
