<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
/**
 * Class ClientCriteria.
 *
 * @package namespace App\Criteria;
 */
class QuotationCriteria implements CriteriaInterface
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
        $status_id = request()->get(config('repository.criteria.params.status_id', 'status_id'), null);
        $client_id = request()->get(config('repository.criteria.params.client_id', 'client_id'), null);
        $propoal_id = request()->get(config('repository.criteria.params.propoal_id', 'propoal_id'), null);
        $owner_user_id = request()->get(config('repository.criteria.params.owner_user_id', 'owner_user_id'), null);
        $currency_id = request()->get(config('repository.criteria.params.currency_id', 'currency_id'), null);
        $start_date = request()->get(config('repository.criteria.params.start_date', 'start_date'), null);
        $end_date = request()->get(config('repository.criteria.params.end_date', 'end_date'), null);
        $until = request()->get(config('repository.criteria.params.until', 'until'), null);
        $since = request()->get(config('repository.criteria.params.since', 'since'), null);

        if(!empty($office_id))
        {
            $model = $model->whereHas('office',function($q) use($office_id){
                $q->where('office_id',$office_id);
            });
        }

        if( !empty($status_id) )
        {
            $model = $model->where('status_id',$status_id);
        }

        if( !empty($client_id) )
        {
            $model = $model->where('client_id',$client_id);
        }

        if( !empty($propoal_id) )
        {
            $model = $model->where('propoal_id',$propoal_id);
        }

        if( !empty($owner_user_id) )
        {
            $model = $model->whereHas('propoal',function($q) use($owner_user_id){
                $q->where('owner_user_id',$owner_user_id);
            });
        }

        if( !empty($currency_id) )
        {
            $model = $model->where('currency$currency_id',$currency_id);
        }

        if(!empty($start_date))
        {
            $model = $model->whereDate('start_date','>=',$start_date);
        }

        if(!empty($end_date))
        {
            $model = $model->whereDate('end_date','>=',$end_date);
        }

        if(!empty($since))
        {
            $model = $model->whereDate('created_at','>=',$since);
        }

        if(!empty($until))
        {
            $model = $model->whereDate('created_at','<=',$until);
        }

        return $model;
    }
}
