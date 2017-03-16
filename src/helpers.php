<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 03/03/2017 14:45
 */

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}