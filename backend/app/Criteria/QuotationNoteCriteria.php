<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
/**
 * Class QuotationNoteCriteria.
 *
 * @package namespace App\Criteria;
 */
class QuotationNoteCriteria implements CriteriaInterface
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
        $quotation_id = request()->get(config('repository.criteria.params.quotation_id', 'quotation_id'), null);
        $until = request()->get(config('repository.criteria.params.until', 'until'), null);
        $since = request()->get(config('repository.criteria.params.since', 'since'), null);
        if( !empty($quotation_id) )
        {
            $model = $model->where('quotation_id', $quotation_id);
        }

        if( !empty($office_id) )
        {
            $q->where('office_id',$office_id);
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
