<?php

namespace App\Botman;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;


class OnboardingConversation extends Conversation
{
    /* user input
name
date
select
radio (yes or no ad other radio)
pic
paragraph/sentence
*/

    /* bot
ask
hear
store
reply
provide option
provide action button to upload,select, and other
*/


    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask('Hello! What is your firstname?', function (Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Nice to meet you ' . $this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function (Answer $answer) {
            // Save result
            $this->email = $answer->getText();
            $this->say('Great ' . $this->firstname);
            $this->askHelp();
        });
    }

    public function askhelp()
    {
        $this->ask('How can i help you today', function (Answer $answer) {
            // Save result
            $help = $answer->getText();
            if (preg_match('/\bform\b/', $help)) {
                $this->askFormtype();
            } else {
                $this->say("sorry i can't help you with that");
                $this->error();
            }
        });
    }

    public function error()
    {
        $this->say("you came to error (type fill form or form )");
        $this->askHelp();
    }


    public function askFormtype()
    {
        $question = Question::create('Which form do you want to fill?')
            ->fallback('error')
            ->addButtons([
                Button::create('Driver Licence')->value('driver'),
                Button::create('Library Card')->value('library'),
                Button::create('Bank Card')->value('bank'),
                Button::create('Student Id Card')->value('student'),

            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                switch ($selectedValue) {
                    case 'driver':
                        $this->askDriverQuestion();
                        break;
                    case 'library':
                        $this->askLibraryQuestion();
                        break;
                    case 'bank':
                        $this->askBankQuestion();
                        break;
                    case 'student':
                        $this->askStudentQuestion();
                        break;
                    default:
                        $this->say("something wrong on askFormType");
                        break;
                }
            }
        });
    }

    public function askDriverQuestion()
    {
        $this->ask('What is your driver licence number', function (Answer $answer) {
            // Save result
            $this->say("continue with driver licence");
        });
    }

    public function askLibraryQuestion()
    {
        $this->ask('What is your Library Reference number', function (Answer $answer) {
            // Save result
            $this->say("continue with  Library card");
        });
    }

    public function askBankQuestion()
    {
        $this->ask('What is your Bank 16 digit code', function (Answer $answer) {
            // Save result
            $this->say("continue with driver licence");
        });
    }

    public function askStudentQuestion()
    {
        $this->ask('What is your student id number', function (Answer $answer) {
            // Save result
            $this->say("continue with student id number");
        });
    }








    public function run()
    {
        // This will be called immediately
        $this->askFirstname();
    }
}
