<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
/**
 * Class UserGoalCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserGoalCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

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
        $user_id = request()->get(config('repository.criteria.params.user_id', 'user_id'), null);
        $until = request()->get(config('repository.criteria.params.until', 'until'), null);
        $since = request()->get(config('repository.criteria.params.since', 'since'), null);
        $status_id = request()->get(config('repository.criteria.params.status_id', 'status_id'), null);

        if( !empty($office_id) )
        {
           $model = $model->where('office_id',$office_id);
        }

        if( !empty($user_id) )
        {
           $model = $model->where('user_id',$user_id);
        }

        if( !empty($status_id) )
        {
           $model = $model->where('status_id',$status_id);
        }


        if(!empty($since))
        {
            $model = $model->where('start_date','>=',$since);
        }

        if(!empty($until))
        {
            $model = $model->where('end_date','<=',$until);
        }
        return $model;
    }
}
