<?php

namespace guessthenumber;

use AlexaPHPSDK\EndSessionRequest;
use AlexaPHPSDK\Response;

class EndSession extends EndSessionRequest {
    
    public function run($params = array()) {
        $message = 'I have been waiting for to long. The number was '.$this->user['numberToGuess'].'. Goodbye.';
        $response = $this->endSessionResponse($message);
        return $response;
    }
    
}