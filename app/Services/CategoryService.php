<?php

namespace App\Services;

use App\Abstracts\BaseService;

class CategoryService extends BaseService
{
    protected $relations = ['parent'];

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

    public function getCategoryParent($params = []){
        $query = $this->_model->query()->select('id', 'name');
        if (!empty($params['parent_id'])) {
            $query->where('parent_id', $params['parent_id']);
        }
        if (!empty($params['is_parent'])) {
            $query->whereNotNull('parent_id');
        } else {
            $query->whereNull('parent_id');
        }
        if (!empty($params['id'])) {
            $query->where('id', '!=', $params['id']);
        }
        return $query->get();
    }
}
