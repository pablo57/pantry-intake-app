<?php
declare(strict_types=1);

namespace pantry\Member;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Member;
use pantry\Models\Household;

/**
 * Class MemberPostAction
 * Required:
 *  - HouseholdId
 *  - DOB
 */
class MemberPostAction
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

        $householdData = [];
        $householdId = $body['HouseholdId'] ?? 0;

        // Not really best practice but in the interest of time...
        if ($householdId === 0) {
            // Add new Household record
            $houseHold = new Household();
            $houseHold->Name = $body['HouseholdName'] ?? $body['LastName'] ?? null;
            if ($houseHold->save()) {
                $houseHoldData['HouseholdId'] = $houseHold->Id;
                $body['HouseholdId'] = $houseHoldData['HouseholdId'];
            } else {
                // TODO: Something went wrong.
            }
        }
        unset($body['HouseholdName']);

        // Add new Member record
        $member = new Member();

        // Replace each key value from the JSON body into the Member model and save.
        foreach ($body as $key => $value) {

            // Special handling for DOB
            if ($key === 'DOB') {
                $value = $value . ' 00:00:00';
            }
            $member->$key = $value;
        }


        if ($member->save()) {
            $data = [
                'status' => 200,
                'data' => array_merge($member->getAttributes(), $householdData)
            ];
        } else {
            //TODO: What went wrong?
        }

        return $response->withJson($data)->withStatus($data['status']);
    }
}
