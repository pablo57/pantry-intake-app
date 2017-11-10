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
        $id = $route->getArgument('id');

        $houseHold = Household::find($id);

        $status = ($houseHold === null) ? 404: 200;
        $data = [
                    'status' => $status,
                    'data' => $houseHold
                ];

        return $response->withJson($data)->withStatus($status);
    }
}
