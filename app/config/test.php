<?php

$db = parse_url(getenv('DATABASE_URL'));

$db2 = substr($db['path'],1);
print_r($db2);
