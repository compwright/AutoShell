<?php
declare(strict_types=1);

namespace AutoShell;

use Throwable;

class Exec
{
    /**
     * @param array<int, mixed> $arguments
     */
    public function __construct(
        public readonly ?string $class = null,
        public readonly ?string $method = null,
        public readonly ?Options $options = new Options(),
        public readonly array $arguments = [],
        public readonly ?Throwable $error = null,
    ) {
    }
}
