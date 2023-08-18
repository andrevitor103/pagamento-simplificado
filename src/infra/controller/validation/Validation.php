<?php

declare(strict_types=1);

namespace src\infra\controller\validation;

interface Validation
{
    public function getRules(): array;
}
