<?php
namespace Marigold\Domain\SharedKernel\Models;

abstract class Entity
{
    /**
     * Map the setting of non-existing fields to a mutator when
     * possible, otherwise use the matching field
     */
    public function __set($name, $value) {
        $field = "_" . strtolower($name);

        if (!property_exists($this, $field)) {
            throw new \InvalidArgumentException(
                "Setting the field '$field' is not valid for this entity.");
        }

        $mutator = "set" . ucfirst(strtolower($name));
        if (method_exists($this, $mutator) &&
            is_callable(array($this, $mutator))) {
            $this->$mutator($value);
        }
        else {
            $this->$field = $value;
        }

        return $this;
    }

    /**
     * Map the getting of non-existing properties to an accessor when 
     * possible, otherwise use the matching field
     */
    public function __get($name) {
        $field = "_" . strtolower($name);

        if (!property_exists($this, $field)) {
            throw new \InvalidArgumentException(
                "Getting the field '$field' is not valid for this entity.");
        }

        $accessor = "get" . ucfirst(strtolower($name));
        return (method_exists($this, $accessor) &&
            is_callable(array($this, $accessor)))
            ? $this->$accessor() : $this->field;
    }

    /**
     * Get the entity fields
     */
    public function toArray() {
        return get_object_vars($this);
    }
}