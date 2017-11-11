<?php
declare(strict_types=1);

namespace pantry\Household;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Household;

class HouseholdGetAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id') ?? 0;

        if ($id > 0) {
            $houseHold = Household::find($id);
        } else {
            $houseHold = Household::all();
        }

        $status = ($houseHold === null) ? 404 : 200;
        $data = [
            'status' => $status,
            'data' => $houseHold
        ];

        return $response->withJson($data)->withStatus($data['status']);
    }
}
