<?php

declare(strict_types=1);

namespace src\infra\http\controller\validation;

interface Validation
{
    public function getRules(): array;
}
