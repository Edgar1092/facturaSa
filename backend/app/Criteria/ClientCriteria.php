<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ClientCriteria.
 *
 * @package namespace App\Criteria;
 */
class ClientCriteria implements CriteriaInterface
{
    public function __construct()
    {

    }
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $parent_id = request()->get(config('repository.criteria.params.parent_id', 'parent_id'), null);
        if( !empty($parent_id) )
        {
            $model = $model->where('parent_id',$parent_id);
        }else{
            $model = $model->whereNull('parent_id');
        }
        $model = $model->where('is_prospect',false);
        return $model;
    }
}
