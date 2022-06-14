<?php

namespace App\Validator;

use App\Entity\Article;
use App\Entity\Status;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PublicationDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var PublicationDate $constraint */

        if (!$value instanceof Article) {
            return;
        }

        if (
            $value->getPublicationDate() !== null
            && ($value->getStatus()?->getId() === Status::DRAFT)
        ) {
            $this->context
                ->buildViolation($constraint->draftShouldntHavePublicationDateMessage)
                ->setInvalidValue($value->getPublicationDate())
                ->addViolation()
            ;
        }
    }
}
