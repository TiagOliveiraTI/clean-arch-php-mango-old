<?php

namespace spec\Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Error;
use PhpSpec\ObjectBehavior;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers\SignUpController;


class SignUpControllerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SignUpController::class);
    }

    public function it_should_return_400_if_no_name_is_provided()
    {

        $httpRequest = (object) [
            'body' => (object) [
                'email' => 'any_email@mail.com',
                'password' => 'any_password',
                'passwordConfirmation' => 'any_password'
            ]
        ];

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new Error('Missing param: name'))->getMessage());
    }

    public function it_should_return_400_if_no_email_is_provided()
    {

        $httpRequest = (object) [
            'body' => (object) [
                'name' => 'any_name',
                'password' => 'any_password',
                'passwordConfirmation' => 'any_password'
            ]
        ];

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new Error('Missing param: email'))->getMessage());
    }
}
