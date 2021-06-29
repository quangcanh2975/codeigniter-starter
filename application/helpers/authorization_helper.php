<?php

class Authorization
{

    public static function validateToken($token)
    {
        try {
            $CI = &get_instance();
            $payload = JWT::decode($token, $CI->config->item('jwt_key'));
            return json_decode(json_encode($payload), TRUE);
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function generateToken($token)
    {
        $CI = &get_instance();
        return JWT::encode($token, $CI->config->item('jwt_key'));
    }

    public static function validateTimestamp($token)
    {
        $token = self::validateToken($token);
        if ($token != false && $token['exp'] > time()) {
            return $token;
        }
        return false;
    }
}
