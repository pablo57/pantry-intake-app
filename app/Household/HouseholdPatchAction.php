<?php
declare(strict_types=1);

namespace pantry\Household;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Household;

class HouseholdPatchAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $body = $request->getParsedBody();

        $status = 404;
        $data = [
            'status' => $status,
            'data' => null
        ];

        // Get the id we are patching
        $id = $body['Id'] ?? 0;

        // Only attempt the patch if we have a valid PK
        if ($id > 0) {

            // Look up the Household via the id (PK).
            $household = Household::find($id);

            // If household is NOT Null then we found an existing record.
            if ($household !== null) {
                foreach ($body as $key => $value) {
                    $household->$key = $value;
                }

                // The save() method will return true if we updated the record.
                if ($household->save()) {

                    $status = 200;
                    $data = [
                        'status' => $status,
                        'data' => $household
                    ];
                } else {
                    $status = 400;
                    $data['status'] = $status;
                }
            }
        }

        return $response->withJson($data)->withStatus($status);
    }
}
