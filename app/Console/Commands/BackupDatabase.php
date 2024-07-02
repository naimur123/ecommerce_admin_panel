<?php

namespace App\Console\Commands;

use App\Notifications\EmailDatabaseBackup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Database Backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $backupDir = storage_path('app/backups');
        $backupFile = $backupDir . '/' . $dbName . '_' . date('Y-m-d_H-i-s') . '.sql';

        // Create the backup directory if it doesn't exist
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        // Create the database backup
        $command = "mysqldump --host=$dbHost --user=$dbUser --password=$dbPass $dbName > $backupFile";
        $result = null;
        $output = [];
        exec($command, $output, $result);

        if ($result !== 0) {
            $this->error('Error creating database backup.');
            return 1;
        }

        Notification::route('mail', env('BACKUP_EMAIL'))
                    ->notify(new EmailDatabaseBackup($backupFile));

        $this->info('Database backup created and email sent to' .env('BACKUP_EMAIL'). 'successfully.');
    }
}
