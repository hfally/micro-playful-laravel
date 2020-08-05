<?php

namespace App\Services;

use App\Exceptions\ValidatorException;

/**
 * Class Validator.
 */
class Validator
{
    private array $errors = [];

    /**
     * Make validation.
     *
     * @param array $fields
     * @param array $validations
     *
     * @throws \App\Exceptions\ValidatorException
     * @return static
     */
    public static function make(array $fields, array $validations): self
    {
        $validator = new self();

        foreach ($validations as $field => $rules) {
            // If the current field does not exists in the $fields ($_POST) list,
            // then break the application with a message.
            if (!isset($fields[$field])) {
                throw new ValidatorException("Field $field does not exist in list of provided fields.");
            }

            // Loop through the rules (value) of the current field.
            $rules = is_array($rules) ? $rules : explode('|', $rules);

            foreach ($rules as $rule) {
                // Split the rule into `rule` and `argument`
                $split = explode(':', $rule);
                $rule = $split[0];
                $rule_validator = strtolower($rule) . 'Validator';

                // Check if the current rule + validator (eg requiredValidator) exists in the Validator class.
                // If it does not exist, break the application with a message.
                if (!method_exists($validator, $rule_validator)) {
                    throw new ValidatorException("Rule $rule does not exist.");
                }

                // Dynamically invoke the current rule method (eg 'required' will be 'requiredValidator')
                if (isset($split[1])) {
                    $validator->$rule_validator($field, $fields[$field], $split[1]);

                    continue;
                }

                $validator->$rule_validator($field, $fields[$field]);
            }
        }

        return $validator;
    }

    /**
     * Beautify field name.
     *
     * @param string $field
     *
     * @return string
     */
    private function beatifyField(string $field): string
    {
        return str_replace('_', ' ', $field);
    }

    /**
     * Invokes Validation exception
     *
     * @throws \App\Exceptions\ValidatorException
     * @return void
     */
    public function validate(): void
    {
        if (!$this->errors) {
            return;
        }

        throw new ValidatorException($this->errors());
    }

    /**
     * Check if validator fails.
     *
     * @return bool
     */
    public function fails()
    {
        return (bool) $this->errors;
    }

    /**
     * Check if validator passes.
     *
     * @return bool
     */
    public function passes()
    {
        return !$this->fails();
    }

    /**
     * Return the list of errors.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors['fields'] ?? [];
    }

    /**
     * Validate that field is not empty.
     *
     * @param $field
     * @param $value
     */
    public function requiredValidator($field, $value): void
    {
        $beautified_field = $this->beatifyField($field);

        // Validates strings, files, arrays
        if ($value == '' || (is_array($value) && ((isset($value['name']) && !$value['name']) || !$value))) {
            $this->errors['fields'][$field][] = "Field $beautified_field can not be empty.";
        }
    }

    /**
     * Validate that field has minimum characters of given number.
     *
     * @param     $field
     * @param     $value
     * @param int $length
     */
    public function minValidator($field, $value, int $length): void
    {
        $beautified_field = $this->beatifyField($field);

        if (strlen($value) < $length) {
            $this->errors['fields'][$field][] = "Field $beautified_field must be $length characters.";
        }
    }

    /**
     * Validate that field is a valid email.
     *
     * @param $field
     * @param $value
     */
    public function emailValidator($field, $value): void
    {
        $beautified_field = $this->beatifyField($field);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors['fields'][$field][] = "Field $beautified_field must be a valid email.";
        }
    }

    /**
     * Validate that field is confirmed.
     *
     * @param $field
     * @param $value
     *
     * @throws \App\Exceptions\ValidatorException
     */
    public function confirmedValidator($field, $value): void
    {
        $beautified_field = $this->beatifyField($field);

        if (!isset($_POST["confirm_$field"])) {
            throw new ValidatorException("Field for confirm_$field does not exits.");
        }

        if ($value != $_POST["confirm_$field"]) {
            $this->errors['fields'][$field][] = "Field $beautified_field must be equal to value of 'confirm $beautified_field'.";
        }
    }

    /**
     * Validate that field contains a pdf file.
     *
     * @param $field
     * @param $value
     *
     * @return void
     */
    public function pdfValidator($field, $value)
    {
        if (!isset($_FILES[$field]) || !$_FILES[$field]['tmp_name']) {
            $this->errors['fields'][$field][] = "PDF must be a file.";

            return;
        }

        $file = $_FILES[$field]['tmp_name'];


        if (mime_content_type($file) != 'application/pdf') {
            $this->errors['fields'][$field][] = "Selected file is not a valid PDF file.";
        }
    }

    /**
     * Validate that value is in given array.
     *
     * @param        $field
     * @param        $value
     * @param string $in
     *
     * @return void
     */
    public function inValidator($field, $value, string $in)
    {
        if (!in_array($value, explode(',', $in))) {
            $this->errors['fields'][$field][] = "Selected {$field} must be in {$in}";
        }
    }
}
