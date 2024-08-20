<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PrepareMigration extends Command
{
    protected $signature = 'migrate:preparing';
    protected $description = 'Prepare for migration by clearing the storage/public directory';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $storagePath = storage_path('app/public');

        // Hapus semua file di storage/public
        File::cleanDirectory($storagePath);

        $this->info('All files in storage/public have been deleted.');
    }
}
