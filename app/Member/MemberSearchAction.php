<?php
declare(strict_types=1);

namespace pantry\Member;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Member;

class MemberSearchAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $results = null;
        $searchParams = $request->getQueryParams();
        $lastName = $searchParams['last_name'] ?? '';

        $id = $searchParams['id'] ?? '';

        if (strlen($lastName) > 0) {
            $results = Member::where('LastName', 'like', $lastName . '%');
        }

        if (strlen($id) > 0) {
            $results = Member::Where('CAST(Id AS CHAR)', 'like', $id . '%');
        }

        $results = Member::get();
        $status = ($results === null) ? 404 : 200;
        $data = [
            'status' => $status,
            'data' => $results
        ];

        return $response->withJson($data)->withStatus($data['status']);
    }
}
