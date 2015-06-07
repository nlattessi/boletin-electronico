<?php

$db = parse_url(getenv('DATABASE_URL'));

$container->setParameter('database_driver', 'pdo_pgsql');
$container->setParameter('database_host', $url['host']);
$container->setParameter('database_port', $url['port']);
$container->setParameter('database_name', $url['name']);
$container->setParameter('database_user', $url['user']);
$container->setParameter('database_password', $url['pass']);
$container->setParameter('secret', getenv('SECRET'));
$container->setParameter('locale', 'en');
$container->setParameter('mailer_transport', null);
$container->setParameter('mailer_host', null);
$container->setParameter('mailer_user', null);
$container->setParameter('mailer_password', null);
