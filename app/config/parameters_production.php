<?php

//$db = parse_url(getenv('DATABASE_URL'));

// $container->setParameter('database_driver', 'pdo_pgsql');
// $container->setParameter('database_host', $db['host']);
// $container->setParameter('database_port', $db['port']);
// $container->setParameter('database_name', $db['name']);
// $container->setParameter('database_user', $db['user']);
// $container->setParameter('database_password', $db['pass']);
$container->setParameter('secret', getenv('SECRET'));
 $container->setParameter('locale', 'en');
$container->setParameter('mailer_transport', null);
$container->setParameter('mailer_host', null);
$container->setParameter('mailer_user', null);
$container->setParameter('mailer_password', null);
