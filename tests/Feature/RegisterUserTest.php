<?php

use Symfony\Component\HttpFoundation\Response;

function completeDataClient(): array
{
    $fake = Faker\Factory::create('pt_BR');

    return [
        'name' => $fake->name,
        'email' => $fake->email,
        'password' => 'password',
        'password_confirmation' => 'password',
        'document' => $fake->cpf(false),
        'type' => 'client',
    ];
}

function completeDataStore(): array
{
    $fake = Faker\Factory::create('pt_BR');

    return [
        'name' => $fake->company,
        'email' => $fake->email,
        'password' => 'password',
        'password_confirmation' => 'password',
        'document' => $fake->cnpj(false),
        'type' => 'store',
        'address' => $fake->address,
        'phone' => $fake->phoneNumber,
    ];
}

it('register new user with client', function () {
    $data = [
        'name' => 'User Test',
        'email' => 'tester@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'document' => '10297481010',
        'type' => 'client',
    ];

    $response = $this->post('api/register', $data);
    $response->assertStatus(Response::HTTP_CREATED);
    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseCount('clients', 1);
});

it('response error when some required data no send', function () {
    $data = [
        'name' => 'User Test',
        'email' => 'tester@test.com',
        'password' => 'password',
        'document' => '10297481010',
        'type' => 'client',
    ];

    $response = $this->post('api/register', $data);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('register new user with store', function () {
    $data = [
        'name' => 'User Test',
        'email' => 'tester@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'document' => '18387569000117',
        'type' => 'store',
        'address' => fake('pt_BR')->address,
        'phone' => fake('pt_BR')->phoneNumber,
    ];

    $response = $this->post('api/register', $data);
    $response->assertStatus(Response::HTTP_CREATED);
    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseCount('stores', 1);
});

it('register new user with client when document has exists', function () {
    $firstUser = completeDataClient();
    $this->post('api/register', $firstUser);

    $secondUser = completeDataClient();
    $secondUser['document'] = $firstUser['document'];
    $response = $this->post('api/register', $secondUser);

    $response->assertStatus(Response::HTTP_BAD_REQUEST);
});

it('register new user with client when email has exists', function () {
    $firstUser = completeDataClient();
    $this->post('api/register', $firstUser);

    $secondUser = completeDataClient();
    $secondUser['email'] = $firstUser['email'];
    $response = $this->post('api/register', $secondUser);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('register new user with store when document has exists', function () {
    $fistStore = completeDataStore();
    $this->post('api/register', $fistStore);

    $secondStore = completeDataStore();
    $secondStore['document'] = $fistStore['document'];
    $response = $this->post('api/register', $secondStore);
    $response->assertStatus(Response::HTTP_BAD_REQUEST);
});

it ('register new user with store when email has exists', function () {
    $firstStore = completeDataStore();
    $this->post('api/register', $firstStore);

    $secondStore = completeDataStore();
    $secondStore['email'] = $firstStore['email'];
    $response = $this->post('api/register', $secondStore);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
