<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author SMAK
 */
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->init();
    }
    
    private function init() {
        echo getenv('cli');
        echo "\n";
        echo "im here";
        echo "\n";
        
    }
    
}
