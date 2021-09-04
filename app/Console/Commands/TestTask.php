<?php

namespace App\Console\Commands;

use App\Models\Lecture;
use Illuminate\Console\Command;

class TestTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle($id)
    {

//        $Lecture = Lecture::find($id);
//
//             if ( $Lecture) {
//                 $Lecture->update(['status' => 'on']);
//             }
        return "Hello" ;
    }
}
