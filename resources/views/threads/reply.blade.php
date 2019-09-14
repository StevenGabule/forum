<div class="card my-4">
    <div class="card-header">
        <div class="level d-flex justify-content-between">
            <h5>
                <a href="/profiles/{{ $reply->owner->name }}">{{ $reply->owner->name }}</a>
                said {{ $reply->created_at->diffForHumans() }}...
            </h5>
            <div>

                <form action="/replies/{{$reply->id}}/favorites" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite',  $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
