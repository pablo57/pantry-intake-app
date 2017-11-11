<?php
declare(strict_types=1);

namespace pantry\Household;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Household;

class HouseholdPostAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        // Assume failure
        $data =
            [
                'status' => 500,
                'data' => null
            ];

        // Get the body as an associative array
        $body = $request->getParsedBody();

        // Add new Household record
        $houseHold = new Household();

        // Replace each key value from the JSON body into the Household model and save.
        foreach ($body as $key => $value) {
            $houseHold->$key = $value;
        }

        if ($houseHold->save()) {
            $data = [
                'status' => 200,
                'data' => $houseHold->getAttributes()
            ];
        }

        return $response->withJson($data)->withStatus($data['status']);
    }
}
