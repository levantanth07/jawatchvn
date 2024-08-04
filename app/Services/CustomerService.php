<?php

namespace App\Services;

use App\Abstracts\BaseService;

class CustomerService extends BaseService
{

    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }

    public function setParams($request, $query)
    {
        if (!empty($request['search'])) {
            $query->where(function ($q) use($request) {
                $search = trim($request['search']);
                $q->where('full_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%");
            });
        }
        return $query;
    }
}
