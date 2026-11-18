@extends('layouts.app')
@section('title', '确认密码')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="auth-page" aria-labelledby="auth-title">
    <div class="auth-card">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">L</div>
            <p class="auth-eyebrow">LaraBBS · 交流与分享</p>
            <h1 id="auth-title">确认密码</h1>
            <p class="auth-description">继续之前，请再次输入账号密码以确认是你本人。</p>
        </header>

        <form class="auth-form" method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="auth-field">
                <label for="password">当前密码</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" placeholder="请输入当前密码" required autocomplete="current-password" autofocus @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p id="password-error" class="auth-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-submit">确认并继续</button>
        </form>

        <p class="auth-switch">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">忘记密码？</a>
            @else
                请妥善保管你的账号密码。
            @endif
        </p>
    </div>
    <p class="auth-caption">为了账号安全，敏感操作需要重新确认密码。</p>
</section>
@endsection
