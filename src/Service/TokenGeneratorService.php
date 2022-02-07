<?php

namespace App\Service;

use App\Interface\UniqIdentifierGeneratorInterface;

class TokenGeneratorService implements UniqIdentifierGeneratorInterface {

    /**
     * @return string
     */
    public function generate(): string {
        return "4587865tr98er541z2e";
    }
}