@extends('layouts.app')

@section('title', $topic->id ? '编辑话题' : '新建话题')
@section('page-class', 'topic-editor-container')

@push('styles')
  <link href="{{ asset('css/topics.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="topic-editor-page">
    <section class="topic-editor-card" aria-labelledby="topic-editor-title">
      <header class="topic-editor-heading">
        <span class="topic-editor-icon" aria-hidden="true">✎</span>
        <h1 id="topic-editor-title">{{ $topic->id ? '编辑话题' : '新建话题' }}</h1>
      </header>

      @if ($topic->id)
        <form class="topic-editor-form" action="{{ route('topics.update', $topic->id) }}" method="POST">
          @method('PUT')
      @else
        <form class="topic-editor-form" action="{{ route('topics.store') }}" method="POST">
      @endif
        @csrf
        @include('shared._error')

        <label class="topic-editor-label" for="topic-title">话题标题</label>
        <input
          class="topic-editor-input"
          id="topic-title"
          type="text"
          name="title"
          value="{{ old('title', $topic->title) }}"
          placeholder="请填写标题"
          required
        >

        <label class="topic-editor-label" for="topic-category">话题分类</label>
        <select class="topic-editor-input" id="topic-category" name="category_id" required>
          <option value="" disabled @selected(!old('category_id', $topic->category_id))>请选择分类</option>
          @foreach ($categories as $category)
            <option
              value="{{ $category->id }}"
              @selected((string) old('category_id', $topic->category_id) === (string) $category->id)
            >{{ $category->name }}</option>
          @endforeach
        </select>

        <label class="topic-editor-label" for="topic-body">话题内容</label>
        <textarea
          class="topic-editor-input topic-editor-body"
          id="topic-body"
          name="body"
          rows="6"
          placeholder="请填入至少三个字符的内容。"
          required
        >{{ old('body', $topic->body) }}</textarea>

        <button class="topic-editor-save" type="submit">
          <span aria-hidden="true">▣</span>
          保存
        </button>
      </form>
    </section>
  </main>
@endsection
