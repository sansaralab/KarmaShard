<?php

namespace AppBundle\Interfaces;

interface DatabaseUploaderInterface
{
    /**
     * Creates unique entities in database from given json.
     * JSON must have ID in every entity.
     *
     * @param string $json
     * @return bool
     */
    public function upload(string $json);
}