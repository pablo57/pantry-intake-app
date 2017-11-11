<?php
declare(strict_types=1);

namespace pantry\Intake;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Intake;

class IntakeGetAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id') ?? 0;

        if ($id > 0) {
            $intake = Intake::find($id);
        } else {
            $intake = Intake::all();
        }

        $status = ($intake === null) ? 404 : 200;
        $data = [
            'status' => $status,
            'data' => $intake
        ];

        return $response->withJson($data)->withStatus($data['status']);
    }
}

