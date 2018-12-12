<?php
require_once '../../core/includes.php';

$r = new Runlog;
$r->delete();
header("Location: /");
exit();
