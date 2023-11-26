<?php

namespace Tests\Feature\API\Response;

use Illuminate\Testing\Fluent\AssertableJson;

class GetAllCompanies200 implements AbstractApiContract
{
    public static function getStructureDefinition(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'address',
                    'users'
                ],
            ],
        ];
    }

    public static function getTypesDefinition(): callable
    {
        $dataTypes = [
            'data.0.id'         => 'string',
            'data.0.name'       => 'string',
            'data.0.address'    => 'string',
            'data.0.users'      => 'array',
            'data.0.users.0.id'           => 'string',
            'data.0.users.0.name_last'    => 'string',
            'data.0.users.0.name_first'   => 'string',
            'data.0.users.0.position'     => 'string',
        ];

        return static function (AssertableJson $json) use ($dataTypes): void {
            $json->whereType('data', 'array')
                ->whereType('meta', 'array')
                ->whereType('links', 'array')
                ->whereAllType($dataTypes);
        };
    }
}
