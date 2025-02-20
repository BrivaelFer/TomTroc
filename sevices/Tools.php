<?php

final class Tools
{
    public static function request(string $param, string $default): string
    {
        return $_REQUEST[$param] ?? $default;
    }
    
}
