<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 
    'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'
   ];
    
    // 一篇帖子属于一个分类。Laravel 用帖子的 category_id 匹配 categories 表的 id。
    // 读取 $topic->category 就能拿到这篇帖子的分类。
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // 一篇帖子属于一个作者。Laravel 用帖子的 user_id 匹配 users 表的 id。
    // 读取 $topic->user 就能拿到这篇帖子的作者。
    public function user() {
        return $this-> belongsTo(User::class);
    }


}
