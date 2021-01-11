<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
/**
 * Class ClientCriteria.
 *
 * @package namespace App\Criteria;
 */
class PassengerCriteria implements CriteriaInterface
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

        if( !empty($client_id) )
        {
            $model = $model->whereHas('quotations',function($q) use($client_id){
                $q->where('client_id', $client_id);
            });
        }

        return $model;
    }
}
