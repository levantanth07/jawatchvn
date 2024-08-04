<?php

namespace App\Abstracts;

use App\Interfaces\BaseServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

abstract class BaseService implements BaseServiceInterface
{
    public $_model;
    protected $relations = [];
    protected $columns = ['*'];
    protected $url_path = ''; // store database
    protected $destination_path = ''; // save image to folder

    function __construct()
    {
        $this->setModel();
    }

    abstract protected function setModel();

    protected function hasInitModel()
    {
        if (!$this->_model) {
            return [
                'status' => 500,
                'message' => 'Model not found!'
            ];
        }
        return true;
    }

    public function index($request = null)
    {
        $query = $this->_model->query();
        if ($this->relations) {
            $query = $query->with($this->relations);
        }
        if ($this->columns) {
            $query = $query->select($this->columns);
        }
        $query = $this->setParams($request, $query);
        if (!empty($request['per_page']) && (int)$request['per_page'] > 0) {
            $query = $query->paginate((int)$request['per_page']);
        } else {
            $query = $query->get();
        }
        return $query;
    }

    public function setParams($request, $query)
    {
        $fillAble = $this->_model->getFillable();
        $params = [];
        if (!empty($request)) {
            $params = $request;
        }
        $arraySearch = array_values(array_intersect($fillAble, array_keys($params)));
        $filtered = array_filter(
            $params,
            function ($key) use ($arraySearch) {
                return in_array($key, $arraySearch);
            },
            ARRAY_FILTER_USE_KEY
        );
        $where = (array_filter($filtered));
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $query = $query->where($key, $value);
            }
        }

        return $query;
    }

    public function store(array $params)
    {
        return $this->_model->query()->create($params);
    }

    public function storeMany(array $params)
    {
        return $this->_model->query()->insert($params);
    }

    public function detail(int $id)
    {
        return $this->_model->query()->find($id);
    }

    public function detailWithRelation(int $id, $relation = [])
    {
        return $this->_model->with($relation)->find($id);
    }

    public function update(int $id, array $params)
    {
        try {
            return $this->detail($id)->update($params);
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateMany($condition, array $params)
    {
        try {
            return $this->_model->query()->where($condition)->update($params);
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete(int $id)
    {
        try {
            return $this->detail($id)->delete();
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function handleUploadedImage(
        $request,
        $field_name = '',
        $file_name = ''
    ): string
    {
        if($request->hasFile($file_name)){
            $image = $request->file($file_name);
            $extension = $image->extension();
            $field_name = $field_name ? Str::slug($request->get($field_name)) .'_'.rand(10,9999) : date('Y-m-d_H:i:s');
            $file_convert = $field_name . '.' . $extension;
            $request->file($file_name)->move($this->destination_path, $file_convert);
            return $this->url_path.$file_convert;
        }
        return '';
    }

    public function deleteImage($file_path): bool
    {
        if(File::exists($file_path)){
            File::delete($file_path);
            return true;
        }
        return false;
    }

    public function deleteMany(array $deleteIds): int
    {
        return $this->_model->destroy($deleteIds);
    }

    public function newQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->_model->query();
    }
}
