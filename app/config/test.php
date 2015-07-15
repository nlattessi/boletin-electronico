<?php

$db = parse_url(getenv('DATABASE_URL'));

print_r($db);
