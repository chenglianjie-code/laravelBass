@extends('layouts.app')
@section('title', '登录')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="auth-page" aria-labelledby="auth-title">
    <div class="auth-card">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">L</div>
            <p class="auth-eyebrow">LaraBBS · 交流与分享</p>
            <h1 id="auth-title">欢迎回来</h1>
            <p class="auth-description">登录你的账号，继续发现值得交流的话题。</p>
        </header>

        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-field">
                <label for="email">邮箱地址</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="请输入你的邮箱" required autocomplete="email" autofocus @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')
                    <p id="email-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password">密码</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" placeholder="请输入密码" required autocomplete="current-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p id="password-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-options">
                <label class="auth-remember" for="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>记住我</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">忘记密码？</a>
                @endif
            </div>

            <button type="submit" class="auth-submit">登录</button>
        </form>

        <p class="auth-switch">还没有账号？<a class="auth-link" href="{{ route('register') }}">立即注册</a></p>
    </div>
    <p class="auth-caption">让每一次交流，都有新的收获。</p>
</section>
@endsection
