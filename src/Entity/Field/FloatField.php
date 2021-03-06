<?php

declare(strict_types=1);

namespace Bolt\Entity\Field;

use Bolt\Entity\Field;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class FloatField extends Field
{
    public function __toString(): string
    {
        return (string) (float) ($this->value);
    }

    public function getValue(): ?array
    {
        return [(float) ($this->value)];
    }
}
