<?php

namespace guessthenumber;

use AlexaPHPSDK\Intent;
use AlexaPHPSDK\Response;

//NO SLOTS

class StopIntent extends Intent {
    
    public function ask($params = array()) {
        return $this->endSessionResponse('Goodbye.');
    }
    
    public function run($params = array()) {
        $numberToGuess = $this->user['numberToGuess'];
        return $this->endSessionResponse('The number was '.$numberToGuess.'. Goodbye.');
    }
    
}