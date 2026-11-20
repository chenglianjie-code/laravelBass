@extends('layouts.app')

@section('title', $topic->id ? '编辑帖子' : '发布帖子')
@section('page-class', 'topics-container')

@push('styles')
  <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
  <link href="{{ asset('css/topics.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="topics-page topic-editor-page">
    <a class="topic-back" href="{{ route('topics.index') }}">← 返回帖子列表</a>
    <header class="topics-heading">
      <h1>{{ $topic->id ? '编辑帖子' : '发布帖子' }}</h1>
    </header>

    <form class="topic-card topic-editor" action="{{ $topic->id ? route('topics.update', $topic->id) : route('topics.store') }}" method="POST" accept-charset="UTF-8">
      @csrf
      @if ($topic->id)
        @method('PUT')
      @endif

      @include('common.error')

      <div class="topic-field">
        <label for="title-field">标题</label>
        <input class="profile-input" type="text" name="title" id="title-field" value="{{ old('title', $topic->title) }}">
      </div>
      <div class="topic-field">
        <label for="body-field">正文</label>
        <textarea class="profile-input topic-body-input" name="body" id="body-field" rows="9">{{ old('body', $topic->body) }}</textarea>
      </div>

      <fieldset class="topic-fieldset">
        <legend>关联与统计</legend>
        <div class="topic-form-grid">
          <div class="topic-field">
            <label for="user_id-field">作者 ID</label>
            <input class="profile-input" type="text" inputmode="numeric" name="user_id" id="user_id-field" value="{{ old('user_id', $topic->user_id) }}">
          </div>
          <div class="topic-field">
            <label for="category_id-field">分类 ID</label>
            <input class="profile-input" type="text" inputmode="numeric" name="category_id" id="category_id-field" value="{{ old('category_id', $topic->category_id) }}">
          </div>
          <div class="topic-field">
            <label for="reply_count-field">回复数</label>
            <input class="profile-input" type="text" inputmode="numeric" name="reply_count" id="reply_count-field" value="{{ old('reply_count', $topic->reply_count) }}">
          </div>
          <div class="topic-field">
            <label for="view_count-field">浏览数</label>
            <input class="profile-input" type="text" inputmode="numeric" name="view_count" id="view_count-field" value="{{ old('view_count', $topic->view_count) }}">
          </div>
          <div class="topic-field">
            <label for="last_reply_user_id-field">最后回复者 ID</label>
            <input class="profile-input" type="text" inputmode="numeric" name="last_reply_user_id" id="last_reply_user_id-field" value="{{ old('last_reply_user_id', $topic->last_reply_user_id) }}">
          </div>
          <div class="topic-field">
            <label for="order-field">排序</label>
            <input class="profile-input" type="text" inputmode="numeric" name="order" id="order-field" value="{{ old('order', $topic->order) }}">
          </div>
        </div>
      </fieldset>

      <div class="topic-field">
        <label for="excerpt-field">摘要</label>
        <textarea class="profile-input profile-textarea" name="excerpt" id="excerpt-field" rows="3">{{ old('excerpt', $topic->excerpt) }}</textarea>
      </div>
      <div class="topic-field">
        <label for="slug-field">Slug</label>
        <input class="profile-input" type="text" name="slug" id="slug-field" value="{{ old('slug', $topic->slug) }}">
      </div>

      <div class="topic-form-actions">
        <a class="topic-button topic-button-secondary" href="{{ route('topics.index') }}">取消</a>
        <button class="topic-button topic-button-primary" type="submit">{{ $topic->id ? '保存修改' : '发布帖子' }}</button>
      </div>
    </form>
  </main>
@endsection
