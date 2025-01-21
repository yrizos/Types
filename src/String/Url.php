<?php

declare(strict_types=1);

namespace Epignosis\Types\String;

use Epignosis\Types\AbstractType;
use InvalidArgumentException;

use const FILTER_NULL_ON_FAILURE;
use const FILTER_SANITIZE_URL;
use const FILTER_VALIDATE_URL;

class Url extends AbstractType
{
    private string $value;

    public function __construct(string $value)
    {
        /** @var string|null $value */
        $value = filter_var($value, FILTER_SANITIZE_URL, FILTER_NULL_ON_FAILURE);

        if (!is_string($value) || !filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Url is invalid');
        }

        $this->value = $value;
    }

    final public function getValue(): string
    {
        return $this->value;
    }
}
