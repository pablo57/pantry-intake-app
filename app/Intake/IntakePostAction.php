<?php
declare(strict_types=1);

namespace pantry\Intake;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Intake;

/**
 * Class IntakePostAction
 * Required:
 *   - HouseholdId
 *   - MemberId
 */
class IntakePostAction
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

        // Add new Intake record
        $intake = new Intake();

        // Replace each key value from the JSON body into the Intake model and save.
        foreach ($body as $key => $value) {
            $intake->$key = $value;
        }

        if ($intake->save()) {
            $data = [
                'status' => 200,
                'data' => $intake->getAttributes()
            ];
        }

        return $response->withJson($data)->withStatus($data['status']);
    }
}
