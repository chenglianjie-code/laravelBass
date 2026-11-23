@if ($topics->count())
  <ul class="topic-list">
    @foreach ($topics as $topic)
      @php
        $author = $topic->user;
        $categoryItem = $topic->category;
        $avatarUrl = $author?->avatar_url;
        $topicTime = $sort === 'recent'
          ? $topic->created_at
          : ($topic->updated_at ?? $topic->created_at);
      @endphp

      <li class="topic-list-item">
        <span class="topic-list-avatar" aria-hidden="true">
          <span>{{ mb_substr($author?->name ?: '？', 0, 1) }}</span>
          @if ($avatarUrl)
            <img
              src="{{ $avatarUrl }}"
              alt=""
              loading="lazy"
              decoding="async"
              onerror="this.remove()"
            >
          @endif
        </span>

        <div class="topic-list-copy">
          <h2 class="topic-list-heading">
            <a class="topic-list-title" href="{{ route('topics.show', $topic) }}">
              {{ $topic->title }}
            </a>
          </h2>

          <div class="topic-list-meta">
            <span class="topic-list-meta-item">
              <span class="topic-list-icon topic-list-icon-folder" aria-hidden="true"></span>

              @if ($categoryItem)
                <a
                  href="{{ route('categories.show', $categoryItem) }}"
                  title="{{ $categoryItem->name }}"
                >{{ $categoryItem->name }}</a>
              @else
                <span>未分类</span>
              @endif
            </span>

            <span class="topic-list-separator" aria-hidden="true">·</span>

            <span class="topic-list-meta-item">
              <span class="topic-list-icon topic-list-icon-person" aria-hidden="true"></span>

              @if ($author)
                <a href="{{ route('users.show', $author) }}">{{ $author->name }}</a>
              @else
                <span>未知作者</span>
              @endif
            </span>

            @if ($topicTime)
              <span class="topic-list-separator" aria-hidden="true">·</span>
              <time class="topic-list-meta-item" datetime="{{ $topicTime->toAtomString() }}">
                <span class="topic-list-icon topic-list-icon-clock" aria-hidden="true"></span>
                {{ $topicTime->diffForHumans() }}
              </time>
            @endif
          </div>
        </div>

        <div class="topic-list-end">
          <span
            class="topic-list-replies"
            aria-label="{{ $topic->reply_count }} 条回复"
            title="{{ $topic->reply_count }} 条回复"
          >{{ $topic->reply_count }}</span>

          @canany(['update', 'destroy'], $topic)
            <details class="topic-list-actions">
              <summary aria-label="管理帖子：{{ $topic->title }}" title="帖子操作">⋯</summary>

              <div class="topic-list-action-menu">
                @can('update', $topic)
                  <a href="{{ route('topics.edit', $topic) }}">编辑</a>
                @endcan

                @can('destroy', $topic)
                  <form
                    action="{{ route('topics.destroy', $topic) }}"
                    method="POST"
                    onsubmit="return confirm('确定删除这篇帖子吗？');"
                  >
                    @csrf
                    @method('DELETE')
                    <button type="submit">删除</button>
                  </form>
                @endcan
              </div>
            </details>
          @endcanany
        </div>
      </li>
    @endforeach
  </ul>

  @if ($topics->hasPages())
    <div class="topic-pagination">
      {{ $topics->onEachSide(1)->links('pagination::default') }}
    </div>
  @endif
@else
  <div class="topic-empty">
    <h2>还没有帖子</h2>
    <a href="{{ route('topics.create') }}">发布第一篇帖子</a>
  </div>
@endif
