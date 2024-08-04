<?php

namespace App\Services;

use App\Abstracts\BaseService;

class ConfigService extends BaseService
{
    protected $url_path = 'uploads/configs/images/'; // store database
    protected $destination_path = 'public/uploads/configs/images/'; // save image to folder
    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }
}
