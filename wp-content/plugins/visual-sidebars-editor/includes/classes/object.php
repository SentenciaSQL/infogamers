<?php

namespace ERROPiX\VCSE;

use ArrayAccess;

class ArrayObject implements ArrayAccess
{
    public function __construct($data = array())
    {
        if (is_array($data)) {
            foreach ($data as $name => $value) {
                $this->__set($name, $value);
            }
        }
    }

    static function __set_state($data = array())
    {
        return new self($data);
    }

    public function __set($name, $value)
    {
        if (is_array($value)) {
            $value = new self($value);
        }
        $this->$name = $value;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }

    public function __isset($name)
    {
        return property_exists($this, $name);
    }

    public function __unset($name)
    {
        unset($this->$name);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }
}
