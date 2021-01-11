<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Auth;
/**
 * Class TaskTypeCriteria.
 *
 * @package namespace App\Criteria;
 */
class TaskTypeCriteria implements CriteriaInterface
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
        $task_type_id = request()->get(config('repository.criteria.params.task_type_id', 'task_type_id'), null);
        $status_id = request()->get(config('repository.criteria.params.status_id', 'status_id'), null);
        $office_id = request()->get(config('repository.criteria.params.office_id', 'office_id'), null);
        $since = request()->get(config('repository.criteria.params.since', 'since'), null);
        $until = request()->get(config('repository.criteria.params.until', 'until'), null);

        if( Auth::user()->hasRole('Vendedor'))
        {
            $model = $model->where('owner_user_id',Auth::user()->id);
        }

        if(!empty($since))
        {
            $model = $model->whereDate('created_at','>=',$since);
        }

        if(!empty($until))
        {
            $model = $model->whereDate('created_at','<=',$until);
        }

        if( !empty($office_id) )
        {
            $model = $model->where('office_id', $office_id);
        }

        if( !empty($status_id) )
        {
            $model = $model->where('status_id', $status_id);
        }

        if( !empty($task_type_id) )
        {
            $model = $model->where('task_type_id', $task_type_id);
        }

        return $model;
    }
}
