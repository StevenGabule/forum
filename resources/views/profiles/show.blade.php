@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-2">
                <h1 class="page-header text-capitalize border-bottom pb-2 mb-3">
                    {{ $profileUser->name }}
                </h1>

                @forelse($activities as $date => $activity)
                    <h3 class="h3">{{ $date }}</h3>
                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.$record->type", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <p>There a no activity for this user yet!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
