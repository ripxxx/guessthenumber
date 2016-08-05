<?php

namespace guessthenumber;

use AlexaPHPSDK\Intent;
use AlexaPHPSDK\Response;

//AMAZON.NUMBER Num

class GuessIntent extends Intent {
    
    public function ask($params = array()) {
        return $this->endSessionResponse('Please run the to play guess the number game.');
    }
    
    public function run($params = array()) {
        $low = $this->user['low'];
        $high = $this->user['high'];
        $numberToGuess = $this->user['numberToGuess'];
        $cnt = $this->user['cnt'];
        $num = ($params['num']*1);
        $response = new Response();
        if(($num < $low) || ($num > $high)) {
            --$cnt;
            $response->addText('This number is out of range. ');
            $response->addText('I guessed the number from '.$low.' to '.$high.'. You have '.$cnt.(($cnt > 1)? ' tries': 'try').'. Try to guess the number.');
            $this->user['cnt'] = $cnt;
        }
        else {
            if($num == $numberToGuess) {
                $response->addText('Congratulations, you guessed the number.');
                $response->forceSessionEnd();
            }
            else if(($cnt-1) < 1) {
                $response->addText('You used all of your tries. The number was '.$numberToGuess);
                $response->forceSessionEnd();
            }
            else {
                --$cnt;
                $response->addText('Did not guess, the number should be '.(($num > $numberToGuess)? 'less': 'bigger').', you have '.$cnt.(($cnt > 1)? ' tries': 'try'));
                $this->user['cnt'] = $cnt;
            }
        }
        $response->setRepromprtMessage('I am waiting. Try to guess the number.');
        return $response;
    }
    
}