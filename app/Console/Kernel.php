<?php

namespace App\Console;

use App\Console\Commands\TestTask;
use App\Models\Lecture;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{

    public $ll;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TestTask::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $Lecture = Lecture::get();
        foreach ($Lecture as $l) {


            if ($l->lecture_date == Carbon::now()->format('Y-m-d')) {
                $this->ll = $l;

                $fl = strtotime($l->lecture_from);
                $f = date('G:i', $fl);
                $tl = strtotime($l->lecture_to);
                $t = date('G:i', $tl);


                $schedule->command('test:test')
                    ->timezone('Asia/Gaza')
//                    ->everyMinute()
                    ->at($f)
                    ->before(function () {
                       echo "status   = " ;
                        $this->ll->status = 'on';
                        $this->ll->save();
                        echo $this->ll->status ;

                    })

                    ->sendOutputTo($this->ll->id);


               $schedule->command('test:test')
                  ->timezone('Asia/Gaza')
//                  ->hourly()
                  ->at($t)
                  ->before(function () {
                      $this->ll->update(['status' => 'null']);
                      echo "status  = " .  $this->ll->status  ;
                  })

                  ->sendOutputTo($this->ll->id);
            }

        }


        // $schedule->command('inspire')->hourly();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
