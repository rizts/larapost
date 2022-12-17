<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
	/**
	 * Register
	 *
	 * @return void
	 */
	public function testRegisterWithError()
	{
		$response = $this->json('PUT', '/api/register', []);

		$response->assertStatus(405);

	}

	/**
	 * Register
	 *
	 * @return void
	 */
	public function testRegister()
	{
		$response = $this->json('POST', '/api/register', []);

		$response->assertStatus(200);

	}

	/**
	 * Login
	 *
	 * @return void
	 */
	public function testLoginWithError()
	{
		$response = $this->json('PUT', '/api/login', []);

		$response->assertStatus(405);

	}

	/**
	 * Login
	 *
	 * @return void
	 */
	public function testLogin()
	{
		$response = $this->json('POST', '/api/login', []);

		$response->assertStatus(200);

	}

	/**
	 * Logout
	 *
	 * @return void
	 */
	public function testLogoutWithError()
	{
		$response = $this->json('PUT', '/api/logout', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(405);

	}

	/**
	 * Logout
	 *
	 * @return void
	 */
	public function testLogout()
	{
		$response = $this->json('POST', '/api/logout', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

}
