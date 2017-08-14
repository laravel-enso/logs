<?php

namespace Tests;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class LogManagerTest extends TestHelper
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->faker = Factory::create();
        $this->log = 'laravel.log';
        $this->signIn(User::first());
    }

    /** @test */
    public function index()
    {
        $this->addLogEntry();

        $this->get('/system/logs')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/logmanager::index')
            ->assertVIewHas(['logs']);

        $this->cleanUp();
    }

    /** @test */
    public function show()
    {
        $this->addLogEntry();

        $this->get('/system/logs/'.$this->log)->assertStatus(200)
            ->assertViewIs('laravel-enso/logmanager::show')
            ->assertVIewHas(['log']);

        $this->cleanUp();
    }

    /** @test */
    public function cant_view_if_file_exceeds_05_mb()
    {
        \Log::info($this->faker->words(30000));

        $this->get('/system/logs/'.$this->log)
            ->assertSessionHas('flash_notification')
            ->assertStatus(302);

        $this->cleanUp();
    }

    /** @test */
    public function download()
    {
        $this->addLogEntry();

        $response = $this->get('/system/logs/download/'.$this->log)
            ->assertStatus(200);

        $this->assertEquals(storage_path('logs/'.$this->log),
            $response->getFile()->getRealPath());

        $this->cleanUp();
    }

    /** @test */
    public function empty()
    {
        $this->addLogEntry();

        $this->delete('/system/logs/'.$this->log)
            ->assertStatus(200);

        $this->assertEquals('', \File::get(storage_path('logs/'.$this->log)));
    }

    private function addLogEntry()
    {
        \Log::info($this->faker->word);
    }

    private function cleanUp()
    {
        $this->delete('/system/logs/'.$this->log);
    }
}
