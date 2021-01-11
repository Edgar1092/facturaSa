<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class VacationRecordCriteria.
 *
 * @package namespace App\Criteria;
 */
class VacationRecordCriteria implements CriteriaInterface
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
        $until = request()->get(config('repository.criteria.params.until', 'until'), null);
        $since = request()->get(config('repository.criteria.params.since', 'since'), null);
        $collaborator_id = request()->get(config('repository.criteria.params.collaborator_id', 'collaborator_id'), null);

        if( !empty($office_id) )
        {
            $model = $model->whereHas('collaborator',function($q) use($office_id){
                $q->where('office_id',$office_id);
            });
        }

        if( !empty($collaborator_id) )
        {
            $model = $model->where('collaborator_id',$collaborator_id);
        }

        if( !empty($since) )
        {
            $model = $model->whereDate('date_start','>=',$since);
        }

        if( !empty($until) )
        {
            $model = $model->whereDate('date_end','<=',$until);
        }
        return $model;
    }
}
