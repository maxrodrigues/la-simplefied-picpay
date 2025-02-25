<?php

use Symfony\Component\HttpFoundation\Response;

it('register new user with client', function () {
    $data = [
        'name'                  => 'User Test',
        'email'                 => 'tester@test.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
        'document'              => '10297481010',
        'type'                  => 'client',
    ];

    $response = $this->post('api/register', $data);
    $response->assertStatus(Response::HTTP_CREATED);
    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseCount('clients', 1);
});

it('response error when some required data no send', function () {
    $data = [
        'name'     => 'User Test',
        'email'    => 'tester@test.com',
        'password' => 'password',
        'document' => '10297481010',
        'type'     => 'client',
    ];

    $response = $this->post('api/register', $data);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('register new user with store', function () {
    $data = [
        'name'                  => 'User Test',
        'email'                 => 'tester@test.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
        'document'              => '18387569000117',
        'type'                  => 'store',
        'address'               => fake('pt_BR')->address,
        'phone'                 => fake('pt_BR')->phoneNumber,
    ];

    $response = $this->post('api/register', $data);
    $response->assertStatus(Response::HTTP_CREATED);
    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseCount('stores', 1);
});

todo('register new user with client when document has exists');
todo('register new user with client when email has exists');
todo('register new user with store when document has exists');
todo('register new user with store when email has exists');
