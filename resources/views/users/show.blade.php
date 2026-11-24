@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@push('styles')
  <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
@endpush
{{-- @dump($user->toArray()) --}}
@section('content')
  <main class="profile-page">
    <section class="profile-card profile-header" aria-label="用户信息">
      @if ($user->avatar_url)
        <img class="profile-avatar-image" src="{{ $user->avatar_url }}" alt="{{ $user->name }} 的头像">
      @else
        <div class="profile-avatar" aria-hidden="true">{{ mb_substr($user->name, 0, 1) }}</div>
      @endif
      <div class="profile-heading">
        <p class="profile-eyebrow">LARABBS · 个人主页</p>
        <h1>{{ $user->name }}</h1>
        <p class="profile-email">{{ $user->email }}</p>
      </div>
    </section>

    <div class="profile-grid">
      <aside class="profile-card profile-about">
        <div class="profile-card-heading">
          <span class="profile-heading-mark" aria-hidden="true">i</span>
          <h2>个人简介</h2>
        </div>
        <p class="profile-bio">{{$user->introduction}}</p>

        <div class="profile-divider"></div>

        <dl class="profile-meta">
          <div>
            <dt>加入时间</dt>
            <dd>{{ $user->created_at ? $user->created_at->format('Y年n月j日') : '未知' }}</dd>
          </div>
        </dl>
      </aside>

      <section class="profile-card profile-posts" aria-label="个人动态">
        @php
          $showReplies = request()->query('tab') === 'replies';
        @endphp

        <nav class="profile-activity-tabs" aria-label="个人动态导航">
          <a
            href="{{ route('users.show', $user) }}"
            @if (!$showReplies) aria-current="page" @endif
          >Ta 的话题</a>
          <a
            href="{{ route('users.show', ['user' => $user, 'tab' => 'replies']) }}"
            @if ($showReplies) aria-current="page" @endif
          >Ta 的回复</a>
        </nav>

        @if ($showReplies)
          <p class="profile-activity-empty">回复功能暂未开放。</p>
        @else
          @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
        @endif
      </section>
    </div>
  </main>
@endsection
