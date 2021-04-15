<?php
declare(strict_types=1);

namespace Marigold\Domain\SharedKernel;

trait Arrayable
{
    //https://stackoverflow.com/questions/4345554/convert-a-php-object-to-an-associative-array
    function objectToArray($obj)
    {
        if (is_object($obj))
            $obj = (array)$this->dismount($obj);
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = $this->objectToArray($val);
            }
        }
        else
            $new = $obj;
        return $new;
    }

    function dismount($object)
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }

    function array_push_assoc(&$array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    function array_push_multi_assoc(&$array, $key1, $key2, $value){
        $array[$key1][$key2] = $value;
        return $array;
    }

    function array_pull_assoc(&$array, $key){
        unset($array[$key]); 
        return $array;
    }

    function array_pull_multi_assoc(&$array, $key1, $key2){
        unset($array[$key][$key2]); 
        return $array;
    }
}