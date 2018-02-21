<?php

namespace Eihen\Devlog\Helpers;

class Helper
{
    public static function getMigrationPath($suffix, $date = null)
    {
        $date = $date ?: date('Y_m_d_His');
        return database_path("migrations/${date}_{$suffix}.php");
    }
}
