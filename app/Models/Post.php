<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'post_type',
        'image',
        'slug',
        'status'
    ];

    const POST_TYPE_SHIPPING = 5; // shipping
    const POST_TYPE_OTHER = 4; // khác
    const POST_TYPE_ABOUT_US = 1; // giới thiệu
    const POST_TYPE_PRIVACY = 2; // chính sách bảo mật
    const POST_TYPE_REFUND_POLICY = 3; // chính sách hoàn trả
}
