<?php
declare(strict_types=1);

namespace Marigold\Domain\SharedKernel;


abstract class GenericCollection implements IteratorAggregate
{
  protected $values;

  public function toArray() : array {
    return $this->values;
  }

  public function getIterator() {
    return new ArrayIterator($this->values);
  }
}