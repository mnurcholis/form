<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Http::withHeaders([
            'Authorization' => config('y59Vw77031Tpb0Cv8dbO5QyJVKVKi6EXoWqHCVZaVDntDUIViSMQuWvz2jkNwePM'),
        ])->withoutVerifying()->post(config('https://pati.wablas.com/api') . "/send-message", [
            'phone' => '6282243041272',
            'message' => "oke",
        ]);
    }
}
