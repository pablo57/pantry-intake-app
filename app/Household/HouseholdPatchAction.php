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
        $id = $body['id'] ?? 0;

        // Only attempt the patch if we have a valid PK
        if ($id > 0) {

            // Look up the Household via the id (PK).
            $household = Household::find($id);

            // If household is NOT Null then we found an existing record.
            if ($household !== null) {
                foreach ($body as $key => $value) {

                    // Ignore the PK we shouldn't allow update on this.
                    if ($key === 'id') {
                        continue;
                    }

                    // Update the household field with the value from the JSON request.
                    $field = ucfirst($key);
                    $household->$field = $value;
                }

                // The save() method will return true if we updated the record.
                if ($household->save()) {

                    $houseHoldData = $household->getAttributes();
                    $houseHoldData = array_change_key_case($houseHoldData, CASE_LOWER);

                    $status = 200;
                    $data = [
                        'status' => $status,
                        'data' => $houseHoldData
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
