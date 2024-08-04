<?php

namespace App\Services;

use App\Abstracts\BaseService;
use Illuminate\Support\Str;

class ProductService extends BaseService
{

    protected $url_path = 'uploads/products/images/'; // store database
    protected $destination_path = 'public/uploads/products/images/'; // save image to folder

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
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($request['campaign_id'])) {
            $query->where('campaign_id', $request['campaign_id']);
        }
        if (!empty($request['category_id'])) {
            $query->where('category_id', $request['category_id']);
        }
        return $query;
    }

    public function update(int $id, array $params)
    {
        $params['slug'] = Str::slug($params['name']);
        return parent::update($id, $params);
    }
}
