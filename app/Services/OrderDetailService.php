<?php

namespace App\Services;

use App\Abstracts\BaseService;

class OrderDetailService extends BaseService
{

    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }
}
