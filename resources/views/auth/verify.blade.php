@extends('layouts.app')
@section('title', '验证邮箱')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="auth-page" aria-labelledby="auth-title">
    <div class="auth-card">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">L</div>
            <p class="auth-eyebrow">LaraBBS · 交流与分享</p>
            <h1 id="auth-title">验证你的邮箱</h1>
            <p class="auth-description">再完成一步，就可以开始使用你的账号。</p>
        </header>

        @if (session('resent'))
            <div class="auth-notice auth-notice-success" role="status">
                新的验证链接已发送，请检查你的邮箱。
            </div>
        @endif

        <div class="auth-verify-copy">
            <p>我们已向你的注册邮箱发送验证链接，请打开邮件并点击链接完成验证。</p>
            <p>如果没有收到邮件，可以重新发送一封。</p>
        </div>

        <form class="auth-form" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="auth-submit">重新发送验证邮件</button>
        </form>

        <p class="auth-switch">验证邮件可能需要几分钟才能到达，请同时检查垃圾邮件文件夹。</p>
    </div>
    <p class="auth-caption">完成邮箱验证，保护你的账号安全。</p>
</section>
@endsection
