<?php

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LogsTest extends TestCase
{
    use RefreshDatabase;

    private $faker;
    private $log;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->log = $this->logFilename();

        File::put($this->logPath(), '');
        clearstatcache();

        $this->seed()
            ->actingAs(User::first());
    }

    public function tearDown(): void
    {
        $this->cleanUp();
        clearstatcache();

        parent::tearDown();
    }

    #[Test]
    public function can_access_logs_index()
    {
        $this->writeLog();

        $this->get(route('system.logs.index', [], false))
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->log]);
    }

    #[Test]
    public function can_view_log()
    {
        $this->writeLog();

        $this->get(route('system.logs.show', $this->log, false))
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->log]);
    }

    #[Test]
    public function cant_view_if_file_exceeds_limit()
    {
        $this->writeLog(str_repeat('oversized-log-entry ', 40000));

        $this->get(route('system.logs.show', $this->log, false))
            ->assertJsonStructure(['message'])
            ->assertStatus(488);
    }

    #[Test]
    public function can_download_log_file()
    {
        $this->writeLog();

        $response = $this->get(route('system.logs.download', $this->log, false))
            ->assertStatus(200)
            ->assertHeader(
                'content-disposition',
                'attachment; filename='.$this->log
            );

        $this->assertEquals(
            storage_path('logs'.DIRECTORY_SEPARATOR.$this->log),
            $response->getFile()->getRealPath()
        );
    }

    #[Test]
    public function empty()
    {
        $this->writeLog();

        $this->delete(route('system.logs.destroy', $this->log, false))
            ->assertStatus(200)
            ->assertJsonStructure(['log', 'message']);

        $this->assertEquals('', File::get($this->logPath()));
    }

    public function can_view_empty_log_after_cleaning_it()
    {
        $this->writeLog();

        $this->delete(route('system.logs.destroy', $this->log, false))
            ->assertStatus(200);

        $this->get(route('system.logs.show', $this->log, false))
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $this->log,
                'content' => '',
            ]);
    }

    #[Test]
    public function destroy_returns_log_metadata_for_cleared_file()
    {
        $this->writeLog();

        $response = $this->delete(route('system.logs.destroy', $this->log, false))
            ->assertStatus(200)
            ->assertJsonStructure(['log', 'message']);

        $this->assertSame($this->log, $response->json('log.name'));
        $this->assertSame(0, $response->json('log.size'));
        $this->assertTrue($response->json('log.visible'));
    }

    private function cleanUp()
    {
        File::delete($this->logPath());
    }

    private function logPath()
    {
        return storage_path('logs').DIRECTORY_SEPARATOR.$this->log;
    }

    private function logFilename(): string
    {
        $token = env('TEST_TOKEN') ?: getmypid();

        return 'laravel-enso-logs-test-'.$token.'-'.$this->faker->unique()->slug().'.log';
    }

    private function writeLog(?string $content = null): void
    {
        File::put(
            $this->logPath(),
            ($content ?? $this->faker->word).PHP_EOL,
        );
        clearstatcache();
    }
}
