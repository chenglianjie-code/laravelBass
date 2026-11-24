@if ($topics->count())
  <ul class="profile-topic-list">
    @foreach ($topics as $topic)
      <li class="profile-topic-row">
        <a href="{{ route('topics.show', $topic) }}">{{ $topic->title }}</a>
        <span class="profile-topic-meta">
          {{ $topic->reply_count }} 条回复
          @if ($topic->created_at)
            <span aria-hidden="true"> · </span>
            <time datetime="{{ $topic->created_at->toAtomString() }}">{{ $topic->created_at->diffForHumans() }}</time>
          @endif
        </span>
      </li>
    @endforeach
  </ul>
@else
  <p class="profile-activity-empty">暂无话题。</p>
@endif

@if ($topics->hasPages())
  <div class="profile-activity-pagination">
    {{ $topics->onEachSide(1)->links('pagination::default') }}
  </div>
@endif
