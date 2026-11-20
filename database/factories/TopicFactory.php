<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        $article = $this->faker->randomElement([
            [
                'title' => '分享一下学习 Laravel 路由的笔记',
                'paragraphs' => [
                    '今天练习了 Laravel 的路由和控制器。浏览器访问一个地址后，框架会找到对应的路由，再调用控制器中的方法处理请求。',
                    '资源路由可以一次声明列表、详情、新增、修改和删除等接口。把路由表和控制器放在一起看，整个请求过程就清晰多了。',
                    '我准备接下来结合帖子功能继续练习，看看路由参数如何通过模型绑定变成可以直接使用的模型对象。',
                ],
            ],
            [
                'title' => '用户和帖子的一对多关系应该怎么理解',
                'paragraphs' => [
                    '一个用户可以发布多篇帖子，每篇帖子都有一个作者。数据库通过帖子表中的 user_id 字段，把帖子和用户关联起来。',
                    '在用户模型中定义 hasMany 关系后，就可以通过用户查询他的帖子。帖子模型中的 belongsTo 关系则可以用来查询作者。',
                    '刚开始容易把关联方法和查询结果混在一起，实际写几次查询，再去数据库对照数据，就容易理解了。',
                ],
            ],
            [
                'title' => '编辑个人资料时遇到的几个问题',
                'paragraphs' => [
                    '最近写了个人资料编辑页面，练习了表单提交、参数验证和模型更新。个人简介虽然已经发送到后端，却没有成功写入数据库。',
                    '检查后发现模型的 fillable 列表里缺少 introduction 字段。补上以后，再次提交就能正常保存了。',
                    '排查时可以依次确认请求数据、验证规则、模型允许赋值的字段和数据库结构，每一步都能帮助缩小问题范围。',
                ],
            ],
            [
                'title' => '用日志观察后端代码的执行过程',
                'paragraphs' => [
                    '调试保存帖子的功能时，我在几个关键位置写了日志，分别记录开始处理、数据验证通过和保存完成。',
                    '通过日志里的用户编号和帖子编号，可以把一次操作的执行过程串起来，也更容易判断异常发生在哪一步。',
                    '本地开发时还可以在终端持续查看日志文件，提交表单后马上就能看到新的记录。',
                ],
            ],
            [
                'title' => '头像上传成功后为什么还是显示不出来',
                'paragraphs' => [
                    '头像上传需要分别检查文件是否保存成功，以及页面使用的图片地址是否正确。文件已经存在时，也可能因为地址不匹配而无法显示。',
                    '在本地切换访问域名后，数据库里保存的旧图片地址可能指向另一个站点。保存相对路径，再根据当前站点生成访问地址更方便。',
                    '给头像设置合适的宽高和 object-fit，还可以让大小不同的图片在导航栏里保持整齐。',
                ],
            ],
            [
                'title' => '记录一次论坛分类数据初始化的练习',
                'paragraphs' => [
                    '论坛发布帖子时需要选择分类，因此安装项目后要先准备分享、教程、问答和公告等默认分类。',
                    '建表迁移负责创建字段和索引，初始化数据则负责插入分类记录。使用迁移或专门的 Seeder 都可以完成数据初始化。',
                    '执行前我会先检查当前数据库和已有记录，确认这次操作会插入哪些数据，避免重复添加同样的分类。',
                ],
            ],
        ]);
        $body = implode("\n\n", $article['paragraphs']);

        return [
            'title' => $article['title'],
            'body' => $body,
            'excerpt' => Str::limit(str_replace("\n\n", ' ', $body), 80),
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4]),
        ];
    }
}
