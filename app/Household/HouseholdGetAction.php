<?php
declare(strict_types=1);

namespace pantry\Household;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use pantry\Models\Household;
use pantry\Models\Member;

class HouseholdGetAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id') ?? 0;
        $includeMembers = false;

        $membersParam = $request->getQueryParam('members') ?? 'false';
        if (strtolower($membersParam) === 'true') {
            $includeMembers = true;
        }

        if ($id > 0) {
            $records = Household::find($id);
            if ($includeMembers) {
                $members = Member::where('HouseholdId', '=', $records->Id)->get();
                if ($members->count() > 0) {
                    $records['members'] = $members;
                }
            }
        } else {
            $houseHold = Household::all();
            $records = [];
            foreach ($houseHold as $record) {
                $members = [];
                if ($includeMembers) {
                    $members = Member::where('HouseholdId', '=', $record->Id)->get();
                }

                if (count($members) > 0) {
                    $record['members'] = $members;
                }
                $records[] = $record;
            }
        }

        $status = ($records !== null) ? 200 : 404;

        $data = [
            'status' => $status,
            'data' => $records
        ];

        return $response->withJson($data)->withStatus($data['status']);
    }
}
