<?php
namespace App;

class Validator {
    private $errors = [];

    public function validate(array $data, array $rules) {
        foreach($rules as $field => $ruleString) {
            $ruleArray = explode('|', $ruleString);
            foreach($ruleArray as $rule) {
                $param = null;
                if (strpos($rule, ':')) {
                    [$rule, $param] = explode(':', $rule);
                }
                $methodName = 'validate' . ucfirst($rule);

                if (method_exists($this, $methodName)) {
                    $this->$methodName($field, $data[$field] ?? null, $param);
                }
            }
        }

        return empty($this->errors);
    }

    public static function sanitize(array $data) {
        return array_map(function ($value) {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }, $data);
    }

    public function validateRequired(string $field, $data) {
        if(empty(trim($data))) {
            $this->errors[$field][] = "Field {$field} is required.";
        }
    }

    public function validateString(string $field, $data) {
        if(!is_string($data)) {
            $this->errors[$field][] = "Field {$field} must be string.";
        }
    }

    public function validateMin(string $field, $data, int $param) {
        if($param > strlen($data)) {
            $this->errors[$field][] = "Field {$field} must be greater than {$param}";
        }
    }

    public function validateEmail(string $field, $data) {
        if(!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Field {$field} must email";
        }
    }

    public function fails() {
        return !empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}