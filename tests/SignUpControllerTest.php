<?php

use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\InvalidParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\MissingParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers\EmailValidatorStub;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers\SignUpController;

class SutTypes
{
    public function __construct(
        public SignUpController $sut,
        public EmailValidatorStub $emailValidatorStub
    ) {}
}

function makeSut(): SutTypes
{
    $emailValidatorStub = new EmailValidatorStub();
    $sut = new SignUpController($emailValidatorStub);

    return new SutTypes(
        $sut,
        $emailValidatorStub
    );
}

test('should return 400 if no name is provided', function () {
    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'email' => 'any_email@mail.com',
            'password' => 'any_password',
            'passwordConfirmation' => 'any_password'
        ]
    );

    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(400);
    expect($httpResponse->body->getMessage())->toEqual((new MissingParamError('name'))->getMessage());
});

test('should return 400 if no email is provided', function () {

    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'password' => 'any_password',
            'passwordConfirmation' => 'any_password'
        ]
    );

    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(400);
    expect($httpResponse->body->getMessage())->toEqual((new MissingParamError('email'))->getMessage());
});

test('should return 400 if no password is provided', function () {

    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'email' => 'any_email@mail.com',
            'passwordConfirmation' => 'any_password'
        ]
    );

    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(400);
    expect($httpResponse->body->getMessage())
        ->toEqual((new MissingParamError('password'))
        ->getMessage());
});

test('should return 400 if no passwordConfirmation is provided', function () {

    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'email' => 'any_email@mail.com',
            'password' => 'any_password'
        ]
    );

    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(400);
    expect($httpResponse->body->getMessage())
        ->toEqual((new MissingParamError('passwordConfirmation'))
        ->getMessage());
});

test('should return 400 if passwordConfirmation fails', function () {

    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'email' => 'any_email@mail.com',
            'password' => 'any_password',
            'passwordConfirmation' => 'invalid_password',
        ]
    );

    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(400);
    expect($httpResponse->body->getMessage())
        ->toEqual((new InvalidParamError('passwordConfirmation'))
        ->getMessage());
});

test('should return 400 if an invalid email is provided', function () {
    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'email' => 'invalid_email@mail.com',
            'password' => 'any_password',
            'passwordConfirmation' => 'any_password'
        ]
    );

    $mock = \Mockery::mock(EmailValidatorStub::class);
    
    $mock
        ->shouldReceive('isValid')
        ->with($httpRequest->body->email)
        ->andReturnFalse();

    $sut = new SignUpController($mock);
    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(400);
    expect($httpResponse->body->getMessage())
    ->toEqual((new InvalidParamError('email'))
    ->getMessage());
});

test('should call EmailValidator with a correct email', function () {
    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'email' => 'invalid_email@mail.com',
            'password' => 'any_password',
            'passwordConfirmation' => 'any_password'
        ]
    );

    $isValidSpy = mock(EmailValidatorStub::class)->expect(
        isValid: fn ($name) => false
    );

    $sut = new SignUpController($isValidSpy);
    $sut->handle($httpRequest);

   expect($isValidSpy)->shouldReceive($httpRequest->body->email);
});

test('should return 500 if EmailValidator throws', function () {
    extract((array) makeSut());

    $httpRequest = new HttpRequest(
        (object) [
            'name' => 'any_name',
            'email' => 'any_email@mail.com',
            'password' => 'any_password',
            'passwordConfirmation' => 'any_password'
        ]
    );

    $isValidSpy = mock(EmailValidatorStub::class)->expect(
        isValid: fn ($name) => throw new Error()
    );
    
    $isValidSpy
        ->shouldReceive('isValid')
        ->with($httpRequest->body->email);

    $sut = new SignUpController($isValidSpy);
    $httpResponse = $sut->handle($httpRequest);

    expect($httpResponse->statusCode)->toBe(500);
    expect($httpResponse->body)
        ->toThrow(Error::class);
});