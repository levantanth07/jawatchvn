<?php

namespace App\Services;

use App\Abstracts\BaseService;

class CampaignService extends BaseService
{

    protected $url_path = 'uploads/campaign/images/'; // store database
    protected $destination_path = 'public/uploads/campaign/images/'; // save image to folder
    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }

    public function setParams($request, $query)
    {
        if (!empty($request['search'])) {
            $search = trim($request['search']);
            $query->where('name', 'LIKE', "%{$search}%");
        }
        return $query;
    }

}
