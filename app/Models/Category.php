<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    // 每当我们创建完数据模型后，都需要设置 Category 的 $fillable 白名单属性，告诉程序哪些字段是支持修改的
    protected $fillable = [
        'name','description'
    ];
}
