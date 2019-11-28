<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('welcome');
    }

    /**
     * Create database backup for all database that mentioned in .env with  BACKUP_DATABASES key
     * and stored in storage/backups/ directory
     */
    public function backupDatabase(){
            //Get all database from env
            $databases =  explode(",", env('BACKUP_DATABASES'));
            foreach ($databases as $database){
                try {
                    $database = trim($database);

                    $filename = date("Y-m-d-H:i:s"). "$database.sql";
                    $storagePath = storage_path("backups/".$filename);
                    $process = new Process(sprintf(
                        'mysqldump -u%s -p%s %s > %s',
                        config('database.connections.mysql.username'),
                        config('database.connections.mysql.password'),
                        $database,
                        $storagePath
                    ));
                    //run cmd to create backup and stored to target directory
                    $process->mustRun();
                    echo "The backup of $database has been proceed successfully and stored path is: $storagePath <br>";
                } catch (ProcessFailedException $exception) {
                    dd($exception->getMessage());
                    echo "The backup of $database process has been failed.<br>";
                }
            }
    }
}
