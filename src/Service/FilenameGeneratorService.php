<?php

namespace App\Service;

use App\Interface\UniqIdentifierGeneratorInterface;

class FilenameGeneratorService implements UniqIdentifierGeneratorInterface {

    /**
     * @return string
     */
    public function generate(): string {
        return uniqid() . ".png";
    }
}