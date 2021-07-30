<?php

namespace Tests;

use App\Controllers\Donation;
use PHPUnit\Framework\TestCase;

class DonationTest extends TestCase
{
    public function test_guest_cannot_submit_donation_with_wrong_input(): void
    {
        $controller = $this->getMockBuilder(Donation::class)
            ->onlyMethods(['jsonResponse'])
            ->getMock();

        $controller->expects($this->once())
            ->method('jsonResponse')
            ->with($this->equalTo(['All fields are required', 'The email field is invalid']), $this->equalTo(422));

        $controller->store();
    }

    public function test_guest_can_submit_donation_with_good_input(): void
    {
        $userInput = [
            'first_name' => 'miid',
            'last_name' => 'dream',
        ];

        $controller = $this->getMockBuilder(Donation::class)
            ->onlyMethods(['jsonResponse', 'setDonation', 'setValidator'])
            ->getMock();

        $controller->method('setDonation');
        $controller->method('setValidator');

        $controller->donation = $this->getDonationMock($userInput);
        $controller->validator = $this->getValidatorMock($userInput);

        $controller->expects($this->once())
            ->method('jsonResponse')
            ->with($this->equalTo(['donation' => $userInput]), $this->equalTo(200));

        $controller->store();
    }

    protected function getDonationMock($data)
    {
        $donation = $this->getMockBuilder(\App\Donation::class)
            ->onlyMethods(['store'])
            ->disableOriginalConstructor()
            ->getMock();

        $donation->expects($this->once())
            ->method('store')
            ->willReturn($data);

        return $donation;
    }

    protected function getValidatorMock($data)
    {
        $validator = $this->getMockBuilder(\App\Validations\DonationValidation::class)
            ->onlyMethods(['data', 'validate'])
            ->disableOriginalConstructor()
            ->getMock();

        $validator->expects($this->once())->method('data')->willReturn($data);
        $validator->expects($this->once())->method('validate')->willReturn([]);

        return $validator;
    }
}
