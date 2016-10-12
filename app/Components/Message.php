<?php

namespace App\Components;

class Message
{
    const INFO = 'info';
    const ERROR = 'error';
    const WARNING = 'warning';
    const SUCCESS = 'success';

    public static function setError($text)
    {
       return self::setMessage(self::ERROR, $text);
    }

    public static function setInfo($text)
    {
        return self::setMessage(self::INFO, $text);
    }

    public static function setWarning($text)
    {
        return self::setMessage(self::WARNING, $text);
    }

    public static function setSuccess($text)
    {
        return self::setMessage(self::SUCCESS, $text);
    }

    public static function setMessage($key, $value)
    {
        session()->flash('mess_' .  $key , $value);
    }

    public  static function hasMessage($type)
    {
        if(session()->has('mess_' . $type)) {
            return session()->get('mess_' . $type);
        }
    }

}