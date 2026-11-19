@extends('layouts.app')

@section('title', '编辑个人资料')

@push('styles')
  <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')
  <main class="edit-profile-page">
    <header class="edit-profile-heading">
      <a class="edit-profile-back" href="{{ route('users.show', $user->id) }}">
        <span aria-hidden="true">←</span> 返回个人主页
      </a>
      <p class="profile-eyebrow">ACCOUNT SETTINGS</p>
      <h1>编辑个人资料</h1>
      <p class="edit-profile-description">更新你的公开信息，让社区里的朋友更好地认识你。</p>
    </header>

    <section class="profile-card edit-profile-card" aria-labelledby="edit-profile-title">
      <div class="edit-profile-card-heading">
        <span class="profile-heading-mark" aria-hidden="true">✎</span>
        <div>
          <h2 id="edit-profile-title">基本信息</h2>
          <p>带有 <span aria-hidden="true">*</span> 的项目为必填项</p>
        </div>
      </div>

      <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
        @csrf
        @method('PATCH')

        @include('shared._error')

        <div class="edit-profile-field">
          <label for="name-field">用户名 <span>*</span></label>
          <input class="profile-input" type="text" name="name" id="name-field"
            value="{{ old('name', $user->name) }}" autocomplete="username" required>
          <p class="edit-profile-hint">使用 3–25 个字符，可包含英文、数字、横杠和下划线。</p>
        </div>

        <div class="edit-profile-field">
          <label for="email-field">邮箱 <span>*</span></label>
          <input class="profile-input" type="email" name="email" id="email-field"
            value="{{ old('email', $user->email) }}" autocomplete="email" required>
        </div>

        <div class="edit-profile-field">
          <label for="introduction-field">个人简介 <span class="optional-label">选填</span></label>
          <textarea class="profile-input profile-textarea" name="introduction" id="introduction-field"
            rows="4" maxlength="80" placeholder="简单介绍一下自己吧（最多 80 个字）">{{ old('introduction', $user->introduction) }}</textarea>
          <p class="edit-profile-hint">最多填写 80 个字符。</p>
        </div>

        <div class="edit-profile-actions">
          <a class="edit-profile-cancel" href="{{ route('users.show', $user->id) }}">取消</a>
          <button class="save-profile-button" type="submit">保存修改 <span aria-hidden="true">→</span></button>
        </div>
      </form>
    </section>
  </main>
@endsection
