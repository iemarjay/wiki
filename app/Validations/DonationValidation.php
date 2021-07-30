<?php

namespace App\Validations;

use Pecee\SimpleRouter\SimpleRouter as Router;

class DonationValidation
{
    protected $errors = [];
    protected $fields = [
        'first_name',
        'last_name',
        'email',
        'street_address',
        'city',
        'country',
        'postal_code',
        'phone',
        'preferred_contact_mode',
        'amount',
        'preferred_payment_option',
        'donation_interval',
        'comments',
    ];

    protected function allFieldsAreRequired()
    {
        if (in_array(null, array_values($this->data()), true)) {
            return $this->errors[] = 'All fields are required';
        }

        return true;
    }

    public function data(string $key = null)
    {
        $input = Router::request()->getInputHandler();
        if ($key) {
            return $input->value($key);
        }

        return $input->all($this->fields);
    }

    public function validate(): array
    {
        $this->allFieldsAreRequired();
        $this->validEmail();

        return $this->errors;
    }

    protected function validEmail()
    {
        if (!filter_var($this->data('email'), FILTER_VALIDATE_EMAIL)) {
            return $this->errors[] = 'The email field is invalid';
        }

        return true;
    }
}
