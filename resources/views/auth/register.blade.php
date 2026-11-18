@extends('layouts.app')
@section('title', '注册')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="auth-page" aria-labelledby="auth-title">
    <div class="auth-card">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">L</div>
            <p class="auth-eyebrow">LaraBBS · 交流与分享</p>
            <h1 id="auth-title">创建你的账号</h1>
            <p class="auth-description">加入社区，从分享你的第一个想法开始。</p>
        </header>

        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="auth-field">
                <label for="name">用户名</label>
                <input id="name" type="text" class="auth-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="希望大家怎么称呼你" required autocomplete="name" autofocus @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                @error('name')
                    <p id="name-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="email">邮箱地址</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="用于登录和找回密码" required autocomplete="email" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')
                    <p id="email-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password">密码</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" placeholder="请设置至少 8 位密码" required autocomplete="new-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p id="password-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password-confirm">确认密码</label>
                <input id="password-confirm" type="password" class="auth-input" name="password_confirmation" placeholder="请再次输入密码" required autocomplete="new-password">
            </div>

            <div class="auth-field">
                <label for="captcha">验证码</label>
                <div class="auth-captcha-row">
                    <input id="captcha" type="text" class="auth-input @error('captcha') is-invalid @enderror" name="captcha" placeholder="请输入图片中的验证码" required autocomplete="off" @error('captcha') aria-invalid="true" aria-describedby="captcha-error" @enderror>
                    <img class="auth-captcha-image" src="{{ captcha_src('flat') }}" onclick="this.src='{{ captcha_src('flat') }}?'+Date.now()" title="点击图片更换验证码" alt="注册验证码，点击图片可更换">
                </div>
                @error('captcha')
                    <p id="captcha-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
                <p class="auth-help">看不清？点击验证码图片换一张。</p>
            </div>

            <button type="submit" class="auth-submit">创建账号</button>
        </form>

        <p class="auth-switch">已经有账号了？<a class="auth-link" href="{{ route('login') }}">返回登录</a></p>
    </div>
    <p class="auth-caption">一个账号，开启更多有趣的交流。</p>
</section>
@endsection
