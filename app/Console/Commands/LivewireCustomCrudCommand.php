<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud 
    {nameOfTheClass? : The name of the Class},
    {nameOfTheModelClass? : The name of the model class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Livewire CRUD';

    /**
     * Our custom class properties here!
     */
    protected $nameOfTheClass;
    protected $nameOfTheModelClass;
    protected $file;
    /**
     * Our custom class properties here!
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Gather all parameters
        $this->gatherParameters();

        //Generates the Livewire Class File
        $this->generateLivewireCrudClassFile();

        //Generates the View FIle
        $this->generateLivewireCrudViewFile();
    }

    public function gatherParameters(){
        $this->nameOfTheClass = $this->argument('nameOfTheClass');
        $this->nameOfTheModelClass = $this->argument('nameOfTheModelClass');

        //If you didn't input the name of the class
        if(!$this->nameOfTheClass){
            $this->nameOfTheClass = $this->ask("Enter class name");
        }

        //If you didn't input the name of the Model class
        if(!$this->nameOfTheModelClass){
            $this->nameOfTheModelClass = $this->ask("Enter model class name");
        }

        //Convert to Studly case
        $this->nameOfTheClass = Str::studly($this->nameOfTheClass);
        $this->nameOfTheModelClass = Str::studly($this->nameOfTheModelClass);
    }

    protected function generateLivewireCrudClassFile(){
        //Set the origin and destination for the livewire class file
        $fileOrigin = base_path('/myStubs/custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/Livewire/'. $this->nameOfTheClass . '.php');

        if($this->file->exists($fileDestination)){
            $this->info("This class is already exists: ". $this->nameOfTheClass. '.php');
            $this->error("Aborting class file creation.");
            return false;
        }
        
        //Get the original string content of the file
        $fileOriginalString = $this->file->get($fileOrigin);
        
        //Replace the string specified in the array sequentially
        $replaceOriginalString = Str::replaceArray('{{}}', 
            [
                $this->nameOfTheModelClass,
                $this->nameOfTheClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                Str::kebab($this->nameOfTheClass), //From "FooBar" to "foo-bar"
            ], 
            $fileOriginalString
        );
        //Put the content into the destination directory
        $this->file->put($fileDestination, $replaceOriginalString);

        $this->info("Livewire class file created: ". $fileDestination);
    }

    
    protected function generateLivewireCrudViewFile(){
        $fileOrigin = base_path('/myStubs/custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/'. Str::kebab($this->nameOfTheClass) . '.blade.php');

        if($this->file->exists($fileDestination)){
            $this->info("This view is already exists: ". $this->nameOfTheClass. '.blade.php');
            $this->error("Aborting view file creation.");
            return false;
        }

        //Copy file to destination
        $this->file->copy($fileOrigin, $fileDestination);
        $this->info("Livewire view file created: ". $fileDestination);
    }
}
