<?php

namespace App\Repositories\Criteries;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class OrderComment extends Criteria
{
    public function apply($model, Repository $repository)
    {
        $query = $model->orderBy('id', 'DESC')->withCount('comments');
        return $query;
    }
}