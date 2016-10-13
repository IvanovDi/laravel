<?php

namespace App\Components;

class Message
{
    const INFO = 'info';
    const ERROR = 'error';
    const WARNING = 'warning';
    const SUCCESS = 'success';
    protected $prefix  = 'mess_';
    protected $message  = '';

    public function setError($text)
    {
       return $this->setMessage(self::ERROR, $text);
    }

    public function setInfo($text)
    {
        return $this->setMessage(self::INFO, $text);
    }

    public function setWarning($text)
    {
        return $this->setMessage(self::WARNING, $text);
    }

    public function setSuccess($text)
    {
        return $this->setMessage(self::SUCCESS, $text);
    }

    protected function setMessage($key, $value)
    {
        session()->flash($this->prefix .  $key , $value);
    }

    public function hasMessage()
    {
        if(session()->has($this->prefix . self::SUCCESS)) {
            $this->message .= ' SUCCESS - ' . session()->get($this->prefix . self::SUCCESS);
        }
        if(session()->has($this->prefix . self::WARNING)) {
            $this->message .= ' WARNING - ' . session()->get($this->prefix . self::WARNING);
        }
        if(session()->has($this->prefix . self::ERROR)) {
            $this->message .= ' ERROR -  ' . session()->get($this->prefix . self::ERROR);
        }
        if(session()->has($this->prefix . self::INFO)) {
            $this->message .= ' INFO - ' . session()->get($this->prefix . self::INFO);
        }
        return $this->message;
    }

}