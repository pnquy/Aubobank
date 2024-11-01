<?php


namespace App\Services;


define('PASSWORD', 'anhnt0212');
define('SECRET', 'anhnt02122023');
define('ADD_ON', 'xG%ZI9o6wt@JQKL3_nUB4A');

class MetechRequestSecurity
{
    public function hash_password($password)
    {
        $result = hash_hmac('sha256', $password, SECRET, false);
        return $result;
    }

    public function encrypt($text)
    {
        $text = $text . ADD_ON;
        $text = base64_encode($text);
        $text = str_replace('=', '', $text);
        $start = substr($text, 0, 10);
        $mid = substr($text, 10, -5);
        $end = substr($text, -5);
        return strrev($start) . $this->generateRandomString(32) . strrev($mid) . $this->generateRandomString(32) . $end . '|' . $this->hash_password(PASSWORD);
    }

    public function decrypt($text, $password = PASSWORD)
    {

        $password_str = @explode('|', $text)[1];
        $password_str2 = $this->hash_password($password);
        if (!hash_equals($password_str, $password_str2)) {
            return [
                'error' => 'decrypt error !'
            ];
        }

        $text = str_replace('=', '', @explode('|', $text)[0]);
        $start = substr($text, 0, 10);
        $mid = substr($text, 42, -37); // 42 = 10 + 32; -37 = -5 -32
        $end = substr($text, -5);
        return strrev($start) . strrev($mid) . $end;
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function decodeDecrypt($text, $password = PASSWORD)
    {
        $decryptPassword = $this->decrypt($text, $password);
        $decode = base64_decode($decryptPassword);
        $result = substr($decode, 0, -strlen(ADD_ON));
        return $result;
    }
}
