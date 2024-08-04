<?php

namespace App\Services;

use App\Abstracts\BaseService;
use App\Models\Post;

class PostService extends BaseService
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
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        return $query;
    }

    public function getPostType(): array
    {
        return [
            Post::POST_TYPE_OTHER => 'Khác',
            Post::POST_TYPE_ABOUT_US => 'Giới thiệu',
            Post::POST_TYPE_PRIVACY => 'Chính sách bảo mật',
            Post::POST_TYPE_REFUND_POLICY => 'Chính sách hoàn trả',
            Post::POST_TYPE_SHIPPING => 'Shipping',
        ];
    }
}
