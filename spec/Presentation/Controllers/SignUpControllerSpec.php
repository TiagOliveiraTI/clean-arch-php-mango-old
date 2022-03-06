<?php

namespace spec\Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use PhpSpec\ObjectBehavior;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\InvalidParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\MissingParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\EmailValidator;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers\EmailValidatorStub;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers\SignUpController;

class SignUpControllerSpec extends ObjectBehavior
{
    public function let()
    {
        $emailValidatorStub = new EmailValidatorStub();
        $this->beConstructedWith($emailValidatorStub, true);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(SignUpController::class);
    }


    public function it_should_return_400_if_no_name_is_provided()
    {

        $httpRequest = new HttpRequest(
            (object) [
                'email' => 'any_email@mail.com',
                'password' => 'any_password',
                'passwordConfirmation' => 'any_password'
            ]
        );

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new MissingParamError('name'))->getMessage());
    }

    public function it_should_return_400_if_no_email_is_provided()
    {
        $httpRequest = new HttpRequest(
            (object) [
                'name' => 'any_name',
                'password' => 'any_password',
                'passwordConfirmation' => 'any_password'
            ]
        );

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new MissingParamError('email'))->getMessage());
    }

    public function it_should_return_400_if_no_password_is_provided()
    {
        $httpRequest = new HttpRequest(
            (object) [
                'name' => 'any_name',
                'email' => 'any_email@mail.com',
                'passwordConfirmation' => 'any_password'
            ]
        );

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new MissingParamError('password'))->getMessage());
    }

    public function it_should_return_400_if_no_password_confirmation_is_provided()
    {
        $httpRequest = new HttpRequest(
            (object) [
                'name' => 'any_name',
                'email' => 'any_email@mail.com',
                'password' => 'any_password'
            ]
        );

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new MissingParamError('passwordConfirmation'))->getMessage());
    }

    public function it_should_return_400_if_an_invalid_email_is_provided($emailValidatorStub)
    {
        $httpRequest = new HttpRequest(
            (object) [
                'name' => 'any_name',
                'email' => 'invalid_email@mail.com',
                'password' => 'any_password',
                'passwordConfirmation' => 'any_password'
            ]
        );

        $emailValidatorStub->beADoubleOf(EmailValidatorStub::class);
        $this->beConstructedWith($emailValidatorStub, false);
        $emailValidatorStub->isValid($httpRequest->body->email);

        $httpResponse = $this->handle($httpRequest);

        $httpResponse->statusCode->shouldReturn(400);

        $httpResponse->body->getMessage()
            ->shouldBe((new InvalidParamError('email'))->getMessage());

    }

    public function it_should_call_EmailValidator_with_correct_email($emailValidatorStub)
    {
        $httpRequest = new HttpRequest(
            (object) [
                'name' => 'any_name',
                'email' => 'any_email@mail.com',
                'password' => 'any_password',
                'passwordConfirmation' => 'any_password'
            ]
        );

        $emailValidatorStub->beADoubleOf(EmailValidatorStub::class);
        $emailValidatorStub->isValid()->willReturn(false);

        $this->beConstructedWith($emailValidatorStub);
        $isValidStub = $emailValidatorStub->isValid($httpRequest->body->email);

        $this->handle($httpRequest);

        $isValidStub
            ->shouldHaveBeenCalled();

    }
}
