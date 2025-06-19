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
    public static function uploadImg(array $file, string $name, string $dir): string|bool
    {
        try {
            $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if(!in_array($ext, ['jpg', 'jpeg', 'png']) || $file['size'] > 10 * 1024 * 1024 )
            {
                return false;
            }
            $path = "Asset/img/$dir/$name.$ext";
            move_uploaded_file($file["tmp_name"], $path);
            return $path;
        } catch (Exception $exception) {
            return false;
        }
    }
    public static function xssClean(string $str): string
    {
        // Utilise htmlspecialchars pour convertir les caractères spéciaux en entités HTML
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
    public static function removeTags(string &$str): void
    {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
    }
    public static function emailValidation(string $str): bool 
    {
        return preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$str);
    }
}
