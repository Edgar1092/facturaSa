<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
/**
 * Class ClientCriteria.
 *
 * @package namespace App\Criteria;
 */
class PaymentCriteria implements CriteriaInterface
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
        $client_id = request()->get(config('repository.criteria.params.client_id', 'client_id'), null);
        $office_id = request()->get(config('repository.criteria.params.office_id', 'office_id'), null);
        $quotation_id = request()->get(config('repository.criteria.params.quotation_id', 'quotation_id'), null);
        $payment_method_id = request()->get(config('repository.criteria.params.payment_method_id', 'payment_method_id'), null);
        $since_date_payment = request()->get(config('repository.criteria.params.since_date_payment', 'since_date_payment'), null);
        $until_date_payment = request()->get(config('repository.criteria.params.until_date_payment', 'until_date_payment'), null);

        if( !empty($client_id) )
        {
            $model = $model->where('client_id', $client_id);
        }

        if( !empty($office_id) )
        {
            $model  = $model->whereHas('quotation.propoal',function($q) use($office_id){
                $q->where('office_id', $office_id);
            });
        }

        if( !empty($quotation_id) )
        {
            $model = $model->where('quotation_id', $quotation_id);
        }
        if( !empty($payment_method_id) )
        {
            $model = $model->where('payment_metho', $payment_method_id);
        }

        if(!empty($since_date_payment))
        {
            $model = $model->whereDate('date_payment','>=',$since_date_payment);
        }

        if(!empty($until_date_payment))
        {
            $model = $model->whereDate('date_payment','>=',$until_date_payment);
        }

        return $model;
    }
}
