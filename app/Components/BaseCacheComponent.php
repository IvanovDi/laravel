<?php

namespace App\Components;



use Carbon\Carbon;

abstract class BaseCacheComponent
{
    protected $item;

    public function get($item)
    {
        $res = '';
        $this->item = $item;
        if (!$this->hasCache()) {
            $data = $this->putCache();
        } else {
            $data = $this->getCache();
        }
        foreach ($data as $key => $value) {
            if($key === $this->item) {
                $res = $value;
            }
        }

        return $res;
    }

    protected function getNameItem()
    {
        return $this->item;
    }

    protected function getTime()
    {
        return Carbon::now()->addHours(1);
    }

    protected function getCacheObject()
    {
        return \Cache::store('file');
    }

    protected function hasCache()
    {
        return $this->getCacheObject()->has($this->getNameItem());
    }

    protected function putCache()
    {
        $data = $this->getDataForCache();
        $this->getCacheObject()->put('likes', $data, $this->getTime());

        return $data;
    }

    protected function getCache()
    {
        return $this->getCacheObject()->get($this->getNameItem());
    }

    public function deleteCache($item)
    {
        if ($this->hasCache()) {
            $this->getCacheObject()->forget($item);
        }
    }

    abstract protected function getDataForCache();
}
