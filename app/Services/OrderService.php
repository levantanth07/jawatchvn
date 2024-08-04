<?php

namespace App\Services;

use App\Abstracts\BaseService;

class OrderService extends BaseService
{
    protected $relations = ['customer'];

    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }
    
    public function setParams($request, $query)
    {
         return $query->with(['orderDetail' => function ($q) {
            $q->with('product');
        }]);
    }
}
