<?php
declare(strict_types=1);

namespace pantry\Member;

use pantry\App;

class MemberController
{
    public function register(App $slim)
    {
        $slim->get('/members[/{id}]', MemberGetAction::class);
        $slim->post('/members', MemberPostAction::class);
        $slim->patch('/members', MemberPatchAction::class);
        // $slim->get('/members/search/{search}', 'SearchClass');
    }
}



