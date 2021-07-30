<?php


namespace App\Controllers;


use App\Validations\DonationValidation;
use Pecee\SimpleRouter\SimpleRouter as Router;

class Donation
{
    /** @var \App\Donation */
    public $donation;
    /** @var DonationValidation $validator */
    public $validator;

    public function __construct()
    {
        $this->setDonation();
        $this->setValidator();
    }

    protected function setDonation(\App\Donation $donation = null): self
    {
        $this->donation = $donation ?? new \App\Donation;

        return $this;
    }

    protected function setValidator(DonationValidation $validation = null): self
    {
        $this->validator = $validation ?? new DonationValidation;

        return $this;
    }

    public function store(): void
    {
        if ($errors = $this->validator->validate()) {
            $this->jsonResponse($errors, 422);
            return;
        }

        $donation = $this->donation->store($this->validator->data());

        $this->jsonResponse(['donation' => $donation]);
    }

    public function jsonResponse($body, $status = 200): void
    {
        Router::response()->httpCode($status)->json($body);
    }

}
