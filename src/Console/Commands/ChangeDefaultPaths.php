<?php

namespace Mnabialek\LaravelMultiDomain\Console\Commands;

use Illuminate\Console\Command;

class ChangeDefaultPaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multi:change-paths 
    {--show-only : Whether changes should be only displayed} 
    {--directory=config/custom : Directory where modified config files should be placed (relative to base_path()}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put configuration files in given directory or displays changes that should be made.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $showOnly = $this->option('show-only');
        
        $directory = base_path($this->option('directory'));
        $files = glob(realpath(__DIR__ .'/../../../config/custom').'/*.php');

        if (!$showOnly) {
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
        }
        
        $existed = false;
        
        if ($showOnly) {
            $this->info("You should make changes for those files\n");
        }
        
        foreach ($files as $file) {
            if ($showOnly) {
                $this->line(basename($file)."\n");
                $this->comment(file_get_contents($file));
            } else {
                $fileName = basename($file);
                if (file_exists($directory . DIRECTORY_SEPARATOR . $fileName)) {
                    $existed = true;
                    $this->warn("File {$fileName} already existed - omitted");
                } else {
                    copy($file, $directory . DIRECTORY_SEPARATOR . $fileName);
                    $this->info("File {$fileName} - created");
                }
            }
        }
        
        if ($existed) {
            $this->warn("\nYou might want to run this command with --show-only parameter to display changes in all files (also those omitted)");
        }
    }
}
