@forelse($threads as $thread)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <div class="d-flex">
                <h4>
                    <a href="{{ $thread->path() }}" class="text-capitalize">
                        @if(auth()->check() && $thread->hasUpdateFor(auth()->user()))
                            <strong>{{ $thread->title }}</strong>
                        @else
                            {{ $thread->title }}
                        @endif
                    </a>
                    <br>
                    <span class="small">Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></span>
                </h4>
            </div>
            <div><a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a></div>
        </div>
        <div class="card-body">
            <div class="body">{{ $thread->body }}</div>
        </div><!-- end of card body -->
        <div class="card-footer">
            {{ $thread->visits()->count() }} visits
        </div>
    </div><!-- end of card -->
@empty
    <p class="text-center">There are no relevant results at this time.</p>
@endforelse
