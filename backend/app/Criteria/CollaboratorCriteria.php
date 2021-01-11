<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CollaboratorCriteria.
 *
 * @package namespace App\Criteria;
 */
class CollaboratorCriteria implements CriteriaInterface
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
        $office_id = request()->get(config('repository.criteria.params.office_id', 'office_id'), null);
        $status_id = request()->get(config('repository.criteria.params.status_id', 'status_id'), null);
        $blood_type_id = request()->get(config('repository.criteria.params.blood_type_id', 'blood_type_id'), null);

        if( !empty($blood_type_id) )
        {
            $model = $model->where('blood_type_id',$blood_type_id);
        }

        if( !empty($status_id) )
        {
            $model = $model->where('status_id',$status_id);
        }

        if( !empty($office_id) )
        {
            $model = $model->where('office_id',$office_id);
        }
        return $model;
    }
}
