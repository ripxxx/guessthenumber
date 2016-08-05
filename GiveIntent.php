<?php

namespace guessthenumber;

use AlexaPHPSDK\Intent;
use AlexaPHPSDK\Response;

define('MAX_TRIES_TO_GIVE', 5);

//AMAZON.NUMBER NumOfTries

class GiveIntent extends Intent {
    
    public function ask($params = array()) {
        return $this->endSessionResponse('Please run the to play guess the number game.');
    }
    
    public function run($params = array()) {
        $cnt = $this->user['cnt'];
        $extraTriesGiven = $this->user['extraTriesGiven'];
        $response = new Response();
        $numOfTries = ($params['numoftries']*1);
        if(!$extraTriesGiven) {
            $this->user['extraTriesGiven'] = true;
            (($numOfTries < 1) || ($numOfTries > MAX_TRIES_TO_GIVE)) && $numOfTries = MAX_TRIES_TO_GIVE;
            $cnt+= $numOfTries;
            $this->user['cnt']= $cnt;
            $response->addText('Ok, I am giving you '.$numOfTries.' more '.(($numOfTries > 1)? ' tries': 'try').'. Now you have '.$cnt.(($cnt > 1)? ' tries': 'try').'. Try to guess the number.');
        }
        else {
            $response->addText('You can ask me for more tries, only one time. You have '.$cnt.(($cnt > 1)? ' tries': 'try').' to guess the number. Try to guess it.');
        }
        $response->setRepromprtMessage('I am waiting. Try to guess the number.');
        return $response;
    }
    
}