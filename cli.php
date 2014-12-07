<?php

/**
 * Cli for CI
 *
 * @author SMAK
 */

putenv("cli=1");
$options = getopt("d:u:p:h:c:");
$_SERVER['argv'][1] = isset($options['c']) ? $options['c'] : 'conn/index';

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