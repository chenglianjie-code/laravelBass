<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $sort = $request->query('sort') === 'recent' ? 'recent' : 'active';

        $topics = Topic::with(['user', 'category'])
            ->where('category_id', $category->id);

        if ($sort === 'recent') {
            $topics->latest('created_at');
        } else {
            $topics->latest('updated_at');
        }

        $topics = $topics
            ->orderByDesc('id')
            ->paginate(5)
            ->appends(['sort' => $sort]);

        return view('topics.index', compact('topics', 'category', 'sort'));
    }
}
