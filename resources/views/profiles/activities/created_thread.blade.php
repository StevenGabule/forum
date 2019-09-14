@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} published a thread
        <a href="{{ $activity->subject->path() }}" class="text-capitalize">"{{ $activity->subject->title }}"</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot

@endcomponent
