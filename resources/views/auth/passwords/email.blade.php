@extends('layouts.app')
@section('title', '找回密码')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="auth-page" aria-labelledby="auth-title">
    <div class="auth-card">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">L</div>
            <p class="auth-eyebrow">LaraBBS · 交流与分享</p>
            <h1 id="auth-title">找回密码</h1>
            <p class="auth-description">输入注册邮箱，我们会把密码重置链接发送给你。</p>
        </header>

        @if (session('status'))
            <div class="auth-notice auth-notice-success" role="status">
                {{ session('status') === 'passwords.sent' ? '密码重置链接已发送到你的邮箱。' : session('status') }}
            </div>
        @endif

        <form class="auth-form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="auth-field">
                <label for="email">邮箱地址</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="请输入注册时使用的邮箱" required autocomplete="email" autofocus @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')
                    <p id="email-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-submit">发送重置链接</button>
        </form>

        <p class="auth-switch">想起密码了？<a class="auth-link" href="{{ route('login') }}">返回登录</a></p>
    </div>
    <p class="auth-caption">请使用注册账号时填写的邮箱地址。</p>
</section>
@endsection
