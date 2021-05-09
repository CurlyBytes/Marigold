<?php
declare(strict_types=1);

namespace Marigold\Domain\SharedKernel\Exceptions;

use Marigold\Domain\SharedKernel\Exceptions\KnownProblem;

final class DomainException extends \Exception
{
    use KnownProblem;
}