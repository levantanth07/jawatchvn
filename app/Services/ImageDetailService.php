<?php

namespace App\Services;

use App\Abstracts\BaseService;
use Illuminate\Support\Str;

class ImageDetailService extends BaseService
{
    protected $url_path = 'uploads/products/details/'; // store database
    protected $destination_path = 'public/uploads/products/details/'; // save image to folder

    protected function setModel()
    {
        $namespaceModel = 'App\Models\\' . str_replace('Service', '', class_basename($this));
        $this->_model = class_exists($namespaceModel) ? new $namespaceModel() : null;
    }

    public function handleUploadedMultiImage(
        $request,
        $field_name = '',
        $file_name = ''
    ): array
    {
        $array = [];
        if($request->hasFile($file_name)){
            foreach ($request->file($file_name) as $file) {
                $extension = $file->extension();
                $field_name = date('d-m-Y').'_'.Str::random(10);
                $file_convert = $field_name . '.' . $extension;
                $file->move($this->destination_path, $file_convert);
                $array[] = $this->url_path.$file_convert;
            }
        }
        if (!empty($array)) {
            return $array;
        }
        return [];
    }
}
