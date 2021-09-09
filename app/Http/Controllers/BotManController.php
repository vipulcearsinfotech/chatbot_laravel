<?php

namespace App\Http\Controllers;

use App\Botman\OnboardingConversation;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{


    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($bot, $message) {
            if ($message === "hi") {
                $bot->startConversation(new OnboardingConversation);
            } else {
                $bot->reply("type hi for testing");
            }
        });

        $botman->listen();
    }
}
