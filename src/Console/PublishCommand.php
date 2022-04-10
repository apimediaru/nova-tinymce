<?php

namespace APIMedia\TinyMCE\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova-tinymce:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all of the Nova TinyMCE resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'nova-tinymce-assets',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'nova-tinymce-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'nova-tinymce-lang',
            '--force' => $this->option('force'),
        ]);

        $this->call('view:clear');
    }
}
