<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/api/users', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/api/users', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/api/users/create', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/api/users/create', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/users', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/users', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShowWithError()
	{
		$response = $this->json('GET', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShow()
	{
		$response = $this->json('GET', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('GET', '/api/users/{user}/edit', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('GET', '/api/users/{user}/edit', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdatePatchWithError()
	{
		$response = $this->json('PATCH', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testPatchUpdate()
	{
		$response = $this->json('PATCH', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('DELETE', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('DELETE', '/api/users/{user}', [], [
			'Authorization' => 'Bearer '
		]);

		$response->assertStatus(401);

	}

}
