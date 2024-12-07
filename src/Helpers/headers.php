<?php
use DP\Config\AllowCors;
(new AllowCors())->init();
header('Content-Type: application/json');