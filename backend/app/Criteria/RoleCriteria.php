<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @package namespace App\Criteria;
 */
class RoleCriteria implements CriteriaInterface
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
        $search = request()->get(config('repository.criteria.params.search', 'search'), null);
        // $office_id = request()->get(config('repository.criteria.params.office_id', 'office_id'), null);
        // if( !empty($office_id) )
        // {
        //     $model = $model->where('office_id', $office_id);
        // }

        return $model;
    }
}
