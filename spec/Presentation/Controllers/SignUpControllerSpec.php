<?php

namespace spec\Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use PhpSpec\ObjectBehavior;
use stdClass;
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
    }
}
