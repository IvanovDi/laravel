<?php

namespace App\Repositories\Criteries;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class LikeCount  extends Criteria
{
    public function apply($model, Repository $repository)
    {
        $query = $model->withCount('likes');
        return $query;
    }
}

