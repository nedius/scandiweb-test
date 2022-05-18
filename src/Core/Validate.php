<?php

namespace Nedius\Core;

class Validate{

    public static function validate($data, $rules) {
        $errors = [];
        foreach ($rules as $key => $value) {
            if(!isset($data[$key])) {
                $errors[$key] = "The $key field is required";
            } else {
                if(!empty($value)) {
                    if(!self::validateRule($data[$key], $value)) {
                        $errors[$key] = "The $key field is invalid";
                    }
                }
            }
        }
        return $errors;
    }

    private static function validateRule($value, $rule) {
        if(strpos($rule, "|") !== false) {
            $rules = explode("|", $rule);
            foreach ($rules as $rule) {
                if(!self::validateRule($value, $rule)) {
                    return false;
                }
            }
            return true;
        }
        if(strpos($rule, ":") !== false) {
            $rule = explode(":", $rule);
            $rule = $rule[0];
        }
        switch ($rule) {
            case "required":
                return !empty($value);
            case "string":
                return is_string($value);
            case "numeric":
                return is_numeric($value);
            case "float":
                return is_float($value);
            case "numericORfloat":
                return is_numeric($value) || is_float($value);
            case "min":
                return strlen($value) >= $rule;
            case "max":
                return strlen($value) <= $rule;
            default:
                return false;
        }
    }
}
