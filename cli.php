<?php

/**
 * Cli for CI
 *
 * @author SMAK
 */

putenv("cli=1");

/*
  |---------------------------------------------------------------
  | CASTING argc AND argv INTO LOCAL VARIABLES
  |---------------------------------------------------------------
  |
 */
$argc = $_SERVER['argc'];
$argv = $_SERVER['argv'];

// INTERPRETTING INPUT
if ($argc > 1 && isset($argv[1])) {
    $_SERVER['PATH_INFO'] = $argv[1];
    $_SERVER['REQUEST_URI'] = $argv[1];
} else {
    die('no param found');
}

/*
  |---------------------------------------------------------------
  | PHP SCRIPT EXECUTION TIME ('0' means Unlimited)
  |---------------------------------------------------------------
  |
 */

set_time_limit(0);

/*
  |---------------------------------------------------------------
  | PHP SCRIPT MEMOERY SIZE ('-1' means Unlimited)
  |---------------------------------------------------------------
  |
 */

ini_set("memory_limit", "-1");

require_once('index.php');

/* End of file test.php */