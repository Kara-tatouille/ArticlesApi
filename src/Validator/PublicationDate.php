<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"CLASS"})
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class PublicationDate extends Constraint
{
    public $draftShouldntHavePublicationDateMessage = 'The value "{{ value }}" is not valid.';
}
