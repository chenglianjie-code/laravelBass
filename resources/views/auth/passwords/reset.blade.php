@extends('layouts.app')
@section('title', '重置密码')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="auth-page" aria-labelledby="auth-title">
    <div class="auth-card">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">L</div>
            <p class="auth-eyebrow">LaraBBS · 交流与分享</p>
            <h1 id="auth-title">设置新密码</h1>
            <p class="auth-description">请设置一个新的密码，完成账号找回。</p>
        </header>

        <form class="auth-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="auth-field">
                <label for="email">邮箱地址</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="请输入注册邮箱" required autocomplete="email" autofocus @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')
                    <p id="email-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password">新密码</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" placeholder="请输入新密码" required autocomplete="new-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p id="password-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password-confirm">确认新密码</label>
                <input id="password-confirm" type="password" class="auth-input" name="password_confirmation" placeholder="请再次输入新密码" required autocomplete="new-password">
            </div>

            <button type="submit" class="auth-submit">重置密码</button>
        </form>

        <p class="auth-switch">想起密码了？<a class="auth-link" href="{{ route('login') }}">返回登录</a></p>
    </div>
    <p class="auth-caption">新密码生效后，请使用新密码登录。</p>
</section>
@endsection
