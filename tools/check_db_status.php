#!/usr/bin/env php
<?php

error_reporting(0);

$dbhost = $argv[1];
$dbuser = $argv[2];
$dbpass = $argv[3];
$dbname = $argv[4];

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    exit(1);
}
