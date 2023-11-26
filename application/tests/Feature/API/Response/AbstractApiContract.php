<?php

namespace Tests\Feature\API\Response;

interface AbstractApiContract
{
    /**
     * Get structure definition contract
     *
     * @return array
     */
    public static function getStructureDefinition(): array;

    /**
     * Get types definition.
     *
     * @return callable
     */
    public static function getTypesDefinition(): callable;
}
