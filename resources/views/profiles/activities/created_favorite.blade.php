@component('profiles.activities.activity')

    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}" class="text-capitalize">{{ $profileUser->name }} favorite's a reply</a>
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot

@endcomponent
