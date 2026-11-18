@extends('layouts.app')
@section('title', '首页')

@push('styles')
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')
<main class="home-page">
    <section class="home-hero" aria-labelledby="home-title">
        <p class="home-eyebrow">LaraBBS · 交流与分享</p>
        @auth
            <h1 id="home-title">欢迎回来，{{ Auth::user()->name }}</h1>
            <p class="home-description">欢迎回到社区，继续发现值得交流的话题。</p>
        @else
            <h1 id="home-title">欢迎来到 LaraBBS</h1>
            <p class="home-description">一个分享想法、交流经验的地方。加入社区，开始你的第一次交流。</p>
            <div class="home-actions">
                <a class="home-button home-button-primary" href="{{ route('register') }}">创建账号</a>
                <a class="home-button home-button-secondary" href="{{ route('login') }}">登录</a>
            </div>
        @endauth
    </section>

    <section class="home-note" aria-label="社区介绍">
        <span class="home-note-mark" aria-hidden="true">L</span>
        <div>
            <h2>让每一次交流，都有新的收获</h2>
            <p>分享你正在学习的内容，也可以从别人的经验中找到灵感。</p>
        </div>
    </section>
</main>
@endsection
