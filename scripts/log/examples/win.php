<?php

require_once '../Log.php';

$conf = array('title' => 'Sample Log Output');
$logger = &Log::singleton('win', 'LogWindow', 'ident', $conf);
for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_EMERG);
}

for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_ALERT);
}

for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_CRIT);
}

for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_ERR);
}

for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_WARNING);
}


for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_NOTICE);
}


for ($i = 0; $i < 50; $i++) {
    $logger->log("Log entry $i", PEAR_LOG_DEBUG);
}