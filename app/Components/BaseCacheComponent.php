<?php

namespace App\Components;

abstract class BaseCacheComponent
{
    protected $cacheName = '';

    public function get()
    {
        if (!$this->hasCache()) {
            $data = $this->putCache();
        } else {
            $data = $this->getCache();
        }

        return $data;
    }

    protected function getCacheLifeTime()
    {
        return time() + 60*60*24*30;
    }

    protected function getCacheObject()
    {
        return \Cache::store('file');
    }

    protected function hasCache()
    {
        return $this->getCacheObject()->has($this->getCacheName());
    }

    protected function putCache()
    {
        $data = $this->getDataForCache();
        $this->getCacheObject()->put($this->getCacheName(), $data, $this->getCacheLifeTime());

        return $data;
    }

    protected function getCache()
    {
        return $this->getCacheObject()->get($this->getCacheName());
    }

    protected function getCacheName()
    {
        return $this->cacheName;
    }

    public function destroyCache()
    {
        if ($this->hasCache()) {
            $this->getCacheObject()->forget($this->getCacheName());
        }
    }

    abstract protected function getDataForCache();
}
