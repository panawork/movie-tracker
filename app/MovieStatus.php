<?php

namespace App;


trait EnumToArray 
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

enum MovieStatus: string
{
    use EnumToArray;

    case WantToWatch = 'want to watch';
    case Watching = 'watching';
    case Finished = 'finished';
}
