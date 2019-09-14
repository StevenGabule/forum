@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-2">
                <h1 class="page-header text-capitalize border-bottom pb-2 mb-3">
                    {{ $profileUser->name }}
                </h1>

                @foreach($activities as $date => $activity)
                    <h3 class="h3">{{ $date }}</h3>
                    @foreach($activity as $record)
                        @include("profiles.activities.$record->type", ['activity' => $record])
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
