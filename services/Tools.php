<?php

final class Tools
{
    public static function request(string $param, ?string $default): string|null
    {
        return $_REQUEST[$param] ?? $default;
    }
    public static function redirect(string $page, array $params = []) : void
    {
        $url = "index.php?page=$page";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }
    public static function hash(string $password): string
    {
        return md5($password);
    }
    public static function comparePassword(string $unhashed, string $hashed): bool
    {
        return static::hash($unhashed) === $hashed;
    }
}
