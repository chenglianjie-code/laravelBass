@extends('layouts.app')

@section('title', $topic->title)
@section('page-class', 'topics-container')

@push('styles')
  <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
  <link href="{{ asset('css/topics.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="topics-page topic-detail-page">
    <nav class="topics-heading" aria-label="帖子操作">
      <a class="topic-back" href="{{ route('topics.index') }}">← 返回帖子列表</a>
      @can('update', $topic)
        <div class="topic-actions">
          <a class="topic-button topic-button-secondary" href="{{ route('topics.edit', $topic->id) }}">
            <span aria-hidden="true">✎</span>
            编辑帖子
          </a>
          <form
            class="topic-delete-form"
            action="{{ route('topics.destroy', $topic->id) }}"
            method="POST"
            onsubmit="return confirm('您确定要删除吗？');"
          >
            @csrf
            @method('DELETE')
            <button class="topic-button topic-button-danger" type="submit">
              <span aria-hidden="true">×</span>
              删除
            </button>
          </form>
        </div>
      @endcan
    </nav>

    @if (session()->has('message'))
      <p class="alert alert-success" role="status">{{ session('message') }}</p>
    @endif

    <article class="topic-card topic-article">
      <header class="topic-article-heading">
        <h1>{{ $topic->title }}</h1>
        <div class="topic-meta">
          <span>作者 ID {{ $topic->user_id }}</span>
          <span>分类 ID {{ $topic->category_id }}</span>
          <span>{{ $topic->reply_count }} 条回复</span>
          <span>{{ $topic->view_count }} 次浏览</span>
        </div>
      </header>
      <div class="topic-body">{{ $topic->body }}</div>
    </article>

    <section class="topic-card topic-information" aria-labelledby="topic-info-title">
      <h2 id="topic-info-title">帖子信息</h2>
      <dl class="topic-data-grid">
        <div><dt>帖子 ID</dt><dd>{{ $topic->id }}</dd></div>
        <div><dt>最后回复者 ID</dt><dd>{{ $topic->last_reply_user_id }}</dd></div>
        <div><dt>排序</dt><dd>{{ $topic->order }}</dd></div>
        <div><dt>Slug</dt><dd>{{ $topic->slug ?: '未设置' }}</dd></div>
        <div class="topic-data-wide"><dt>摘要</dt><dd class="topic-data-excerpt">{{ $topic->excerpt ?: '暂无摘要' }}</dd></div>
      </dl>
    </section>
  </main>
@endsection
