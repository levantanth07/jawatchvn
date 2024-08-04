<?php

namespace App\Services;

use App\Abstracts\BaseService;

class FeedBackService extends BaseService
{
    protected $url_path = 'uploads/feedback/images/'; // store database
    protected $destination_path = 'public/uploads/feedback/images/'; // save image to folder

    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }
}
