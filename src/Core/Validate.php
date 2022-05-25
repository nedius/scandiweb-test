<?php

namespace Nedius\Core;

class Validate{

    public static function validate($data, $rules) {
        $errors = [];
        foreach ($rules as $key => $value) {
            if(!empty($value)) {
                $result = self::validateRule($data[$key], $value);
                if(is_string($result)) {
                    $errors[$key] = "The $key $result";
                } elseif(is_array($result) && !empty($result)) {
                    $arr = array();
                    foreach ($result as $value) {
                        $arr[] = "The $key $value";
                    }
                    $errors = $arr;
                }
            }
        }
        return $errors;
    }

    private static function validateRule($value, $rule) {
        if(strpos($rule, "|") !== false) {
            $rules = explode("|", $rule);
            $results = [];
            foreach ($rules as $rule) {
                $result = self::validateRule($value, $rule);
                if(is_string($result)) {
                    $results[] = $result;
                }
            }
            return $results;
        }
        if(strpos($rule, ":") !== false) {
            $rules = explode(":", $rule);
            $rule = $rules[0];
            $subRule = $rules[1];
        }
        switch ($rule) {
            case "required":
                return !empty($value) ?: "is required";
            case "string":
                return is_string($value) ?: "must be a string";
            case "numeric":
                return is_numeric($value) ?: "must be a number";
            case "float":
                return is_float($value) ?: "must be a float";
            case "numericORfloat":
                return is_numeric($value) || is_float($value) ?: "must be a number or float";
            case "min":
                if(is_string($value)) {
                    return strlen($value) >= $subRule ?: "is too short";
                } else {
                    return $value >= $subRule ?: "is too small";
                }
            case "max":
                if(is_string($value)) {
                    return strlen($value) <= $subRule ?: "is too long";
                } else {
                    return $value <= $subRule ?: "is too large";
                }
            case "not_null":
                return $value !== null ?: "is required (null)";
            default:
                return false;
        }
    }
}
