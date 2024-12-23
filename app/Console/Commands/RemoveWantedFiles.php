<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveWantedFiles extends Command
{
   
    protected $signature = 'remove:wantedfiles';

    protected $description = 'This Command will be remove unwanted files from stroge tempFiles Folder';

   
    public function __construct(){
        parent::__construct();
    }


    public function handle(){
        $notremovetodays = [];
        for($i=0; $i<=7; $i++){
            $notremovetodays[] =  strtoupper(date('dMY', strtotime('-'.$i.' day')));
        }
        $notremovetodays = ['.', '..'] + $notremovetodays;
        $path = storage_path('tmpFiles');
        $removableDir = array_diff(scandir($path), $notremovetodays);

        foreach($removableDir as $dirpath){
            $dir = storage_path('tmpFiles/'.$dirpath);
            $this->deleteDirFilesAndMainDir($dir);
        }

        echo "Cron run successfuly at " . date('d-m-Y H:i:s');
    }

    function deleteDirFilesAndMainDir($dir){
        $files = array_diff(scandir($dir), array('.', '..')); 
        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }
        return rmdir($dir); 
    }
 
}
