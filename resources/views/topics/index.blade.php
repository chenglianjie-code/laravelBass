@extends('layouts.app')

@section('title', '帖子列表')
@section('page-class', 'topics-container')

@push('styles')
  <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
  <link href="{{ asset('css/topics.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="topics-page">
    <header class="topics-heading">
      <h1>帖子列表</h1>
      <a class="topic-button topic-button-primary" href="{{ route('topics.create') }}">发布帖子</a>
    </header>

    @if (session()->has('message'))
      <p class="alert alert-success" role="status">{{ session('message') }}</p>
    @endif

    <section class="topic-card" aria-label="帖子列表">
      @if ($topics->count())
        <div class="topic-table-scroll" role="region" aria-label="帖子数据，可横向滚动查看所有字段" tabindex="0">
          <table class="topic-table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">标题</th>
                <th scope="col">正文</th>
                <th scope="col">作者 ID</th>
                <th scope="col">分类 ID</th>
                <th scope="col">回复</th>
                <th scope="col">浏览</th>
                <th scope="col">最后回复者 ID</th>
                <th scope="col">排序</th>
                <th scope="col">摘要</th>
                <th scope="col">Slug</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($topics as $topic)
                <tr>
                  <td class="topic-id">{{ $topic->id }}</td>
                  <td class="topic-title-cell">
                    <a class="topic-title-link" href="{{ route('topics.show', $topic->id) }}">{{ $topic->title }}</a>
                  </td>
                  <td><div class="topic-cell-text">{{ $topic->body }}</div></td>
                  <td>{{ $topic->user_id }}</td>
                  <td>{{ $topic->category_id }}</td>
                  <td>{{ $topic->reply_count }}</td>
                  <td>{{ $topic->view_count }}</td>
                  <td>{{ $topic->last_reply_user_id }}</td>
                  <td>{{ $topic->order }}</td>
                  <td><div class="topic-cell-text">{{ $topic->excerpt }}</div></td>
                  <td><div class="topic-cell-text">{{ $topic->slug }}</div></td>
                  <td>
                    <div class="topic-row-actions">
                      <a class="topic-action" href="{{ route('topics.show', $topic->id) }}" aria-label="查看帖子 {{ $topic->id }}">查看</a>
                      <a class="topic-action" href="{{ route('topics.edit', $topic->id) }}" aria-label="编辑帖子 {{ $topic->id }}">编辑</a>
                      <form action="{{ route('topics.destroy', $topic->id) }}" method="POST" onsubmit="return confirm('确定删除这篇帖子吗？');">
                        @csrf
                        @method('DELETE')
                        <button class="topic-action topic-action-danger" type="submit" aria-label="删除帖子 {{ $topic->id }}">删除</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @if ($topics->hasPages())
          <div class="topic-pagination">{{ $topics->onEachSide(1)->links('pagination::default') }}</div>
        @endif
      @else
        <div class="topic-empty">
          <h2>还没有帖子</h2>
          <p>发布第一篇帖子，开始交流吧。</p>
          <a class="topic-button topic-button-primary" href="{{ route('topics.create') }}">发布帖子</a>
        </div>
      @endif
    </section>
  </main>
@endsection
