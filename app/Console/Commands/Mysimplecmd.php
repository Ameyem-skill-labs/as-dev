<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
class Mysimplecmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:c';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to run simple programes';

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
     * @return mixed
     */
    public function handle()
    {
        $boringLanguage = 'en_Boring';

        // var_dump(Corbon::now());
        $now = Carbon::now();
        echo $now; 
        
        $gameStart = Carbon::parse('2019-02-23 17:35:44', 'Asia/Kolkata');
        // $diff=Carbon::now()- $gameStart;
        echo $gameStart;
        echo '
        ';
        echo $now->diffForHumans($gameStart); // 3 boring days before
        var_dump( $now->diffInDays($gameStart)); // 3 boring days before
        var_dump( $now->diffInHours($gameStart)); // 3 boring days before
        $userid=1;$quiz_id=6;

        $now = Carbon::now();
        $exam_submitted = DB::table('online_quiz_results')->where('user_id',$userid)->where('quiz_id',$quiz_id)->first(['created_at']);
        // $gameStart = Carbon::parse($exam_submitted->created_at, 'Asia/Kolkata');
        $gameStart = Carbon::parse($exam_submitted->created_at, 'UTC');
        if($now->diffInHours($gameStart)>48){
            echo 'Now it can be opened';
        }else{
            echo 'Results will be opened in '.(string)(48-$now->diffInHours($gameStart)) .'hours';
        }
        echo '
        ';
        echo $gameStart;echo '
        ';
        echo $now->diffInHours($gameStart);
        
        // var_dump($result_not_exists);
    }
}
