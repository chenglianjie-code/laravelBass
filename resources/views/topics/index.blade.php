@extends('layouts.app')

@section('title', isset($category) ? $category->name : '话题列表')
@section('page-class', 'topic-list-container')

@push('styles')
  <link href="{{ asset('css/topics.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="topic-list-page" aria-label="话题列表">
    @if (session()->has('message'))
      <p class="alert alert-success topic-list-message" role="status">
        {{ session('message') }}
      </p>
    @endif

    @if (isset($category))
      <div class="alert alert-info topic-list-category" role="status">
        <strong>{{ $category->name }}</strong>
        <span>{{ $category->description }}</span>
      </div>
    @endif

    <section class="topic-list-card" aria-label="帖子">
      <nav class="topic-list-tabs" aria-label="话题导航">
        @if (isset($category))
          <a
            class="topic-list-tab"
            href="{{ route('categories.show', ['category' => $category]) }}"
            title="当前按帖子更新时间排序"
            @if ($sort === 'active') aria-current="page" @endif
          >最后回复</a>
          <a
            class="topic-list-tab"
            href="{{ route('categories.show', ['category' => $category, 'sort' => 'recent']) }}"
            @if ($sort === 'recent') aria-current="page" @endif
          >最新发布</a>
        @else
          <a
            class="topic-list-tab"
            href="{{ route('topics.index') }}"
            title="当前按帖子更新时间排序"
            @if ($sort === 'active') aria-current="page" @endif
          >最后回复</a>
          <a
            class="topic-list-tab"
            href="{{ route('topics.index', ['sort' => 'recent']) }}"
            @if ($sort === 'recent') aria-current="page" @endif
          >最新发布</a>
        @endif

        <a class="topic-list-publish" href="{{ route('topics.create') }}">发布帖子</a>
      </nav>

      @include('topics._topic_list', ['topics' => $topics, 'sort' => $sort])
    </section>

    <aside class="topic-list-sidebar" aria-label="右边导航栏">
      @include('topics._sidebar')
    </aside>
  </main>
@endsection
