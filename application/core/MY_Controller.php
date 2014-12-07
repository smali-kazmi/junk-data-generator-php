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

        $dbSettings = $this->getMappedCliArgs();

        if (!isset($this->db)) {
            $dsn = $dbSettings['driver']
                    . '://'
                    . $dbSettings['username']
                    . ':'
                    . $dbSettings['password']
                    . '@'
                    . $dbSettings['host']
                    . '/'
                    . $dbSettings['database'];

            $this->load->database($dsn);
        }
    }

    private function getMappedCliArgs() {
        $options = getopt("d:u:p:h:c:");

        return array(
            'driver' => isset($options['l']) ? $options['l'] : 'mysql',
            'username' => isset($options['u']) ? $options['u'] : 'root',
            'password' => isset($options['p']) ? $options['p'] : '',
            'host' => isset($options['h']) ? $options['h'] : 'localhost',
            'database' => isset($options['d']) ? $options['d'] : ''
        );
    }

}
