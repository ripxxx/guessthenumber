<?php

namespace guessthenumber;

use AlexaPHPSDK\LaunchRequest;
use AlexaPHPSDK\Response;

define('MAX_TRIES', 10);
define('RANGE_MAX', 100);

class Launch extends LaunchRequest {
    
    public function run($params = array()) {
        $response = new Response();
        
        $low = rand(0, intval(RANGE_MAX/4));
        $high = rand(intval(RANGE_MAX/2), RANGE_MAX);
        $numberToGuess = rand($low, $high);
        
        $this->user['low'] = $low;
        $this->user['high'] = $high;
        $this->user['numberToGuess'] = $numberToGuess;
        $this->user['cnt'] = MAX_TRIES;
        $this->user['extraTriesGiven'] = false;
        
        $response->addText('I guessed the number from '.$low.' to '.$high.', try to guess! You have '.MAX_TRIES.((MAX_TRIES > 1)? ' tries': 'try').'. Goodluck!');
        $response->setRepromptMessage('I am waiting. Try to guess the number.');
        return $response;
    }
    
}

