@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@push('styles')
  <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="profile-page">
    <section class="profile-card profile-header" aria-label="用户信息">
      <div class="profile-avatar" aria-hidden="true">{{ mb_substr($user->name, 0, 1) }}</div>
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
        <p class="profile-bio">这个用户还没有填写个人简介。</p>

        <div class="profile-divider"></div>

        <dl class="profile-meta">
          <div>
            <dt>加入时间</dt>
            <dd>{{ $user->created_at ? $user->created_at->format('Y年n月j日') : '未知' }}</dd>
          </div>
        </dl>
      </aside>

      <section class="profile-card profile-posts" aria-labelledby="profile-posts-title">
        <div class="profile-section-heading">
          <div>
            <p class="profile-eyebrow">ACTIVITY</p>
            <h2 id="profile-posts-title">发布的微博</h2>
          </div>
          <span class="profile-count">动态</span>
        </div>

        <div class="profile-empty">
          <span class="profile-empty-icon" aria-hidden="true">✦</span>
          <h3>还没有发布内容</h3>
          <p>这个用户发布微博后，会展示在这里。</p>
        </div>
      </section>
    </div>
  </main>
@endsection
