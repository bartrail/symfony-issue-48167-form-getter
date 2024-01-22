<?php

namespace App\Model;

class MyObject
{
    private ?int $value;

    public function setValue(?int $newValue): void
    {
        $this->value = $newValue;
    }

    public function getConfiguredValue(): ?int
    {
        return $this->value;
    }

    public function getActualValue(): int
    {
        return $this->value ?? 42;
    }
}
