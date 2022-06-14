<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PublicationDate extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public $draftShouldntHavePublicationDateMessage = 'A draft Article should not have a publication date';
}
