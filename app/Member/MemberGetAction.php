<?php
declare(strict_types=1);

namespace pantry\Member;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Member;

class MemberGetAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id') ?? 0;

        if ($id > 0) {
            $member = Member::find($id);
        } else {
            $member = Member::all();
        }

        $status = ($member === null) ? 404 : 200;
        $data = [
            'status' => $status,
            'data' => $member
        ];

        return $response->withJson($data)->withStatus($data['status']);
    }
}

