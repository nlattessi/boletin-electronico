<?php

namespace Acme\boletinesBundle;

use Composer\Script\Event;

class HerokuDatabase
{
    public static function populateEnvironment(Event $event)
    {
        $url = getenv("DATABASE_URL");

        if ($url) {
            $url = parse_url($url);
            putenv("DATABASE_DRIVER=pdo_pgsql");
            putenv("DATABASE_HOST={$url['host']}");
            putenv("DATABASE_PORT={$url['port']}");
            putenv("DATABASE_NAME={$url['name']}");
            putenv("DATABASE_USER={$url['user']}");
            putenv("DATABASE_PASSWORD={$url['pass']}");
        }

        $io = $event->getIO();

        $io->write("DATABASE_URL=".getenv("DATABASE_URL"));
    }
}
