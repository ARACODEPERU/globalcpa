<?php

namespace Tests\Unit;

use Tests\TestCase;

class MailablesConfigurationTest extends TestCase
{
    /**
     * @return array<int, string>
     */
    private function mailableFiles(): array
    {
        return array_merge(
            glob(base_path('app/Mail/*.php')) ?: [],
            glob(base_path('Modules/*/Emails/*.php')) ?: [],
        );
    }

    public function test_los_mailables_no_usan_env_directamente(): void
    {
        foreach ($this->mailableFiles() as $file) {
            $source = file_get_contents($file);

            $this->assertStringNotContainsString("env('MAIL_", $source, $file);
            $this->assertStringNotContainsString("env('APP_NAME", $source, $file);
        }
    }

    public function test_los_mailables_de_produccion_implementan_should_queue(): void
    {
        foreach ($this->mailableFiles() as $file) {
            $source = file_get_contents($file);

            $this->assertStringContainsString(
                'implements ShouldQueue',
                $source,
                "El mailable no está encolado: {$file}"
            );
        }
    }
}
