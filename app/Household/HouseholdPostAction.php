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
        $body = $request->getParsedBody();

        $houseHold = new Household();
        $houseHold->Name = $body['name'];
        $houseHold->save();

        $houseHoldData = $houseHold->getAttributes();
        $houseHoldData = array_change_key_case($houseHoldData, CASE_LOWER);

        $status = 200;
        $data = [
            'status' => $status,
            'data' => $houseHoldData
        ];

        return $response->withJson($data)->withStatus($status);
    }
}
