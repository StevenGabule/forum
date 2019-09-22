@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('threads._list')
                {{ $threads->render() }}
            </div><!-- end of col-md-8 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Trending Threads
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($trending as $trend)
                            <li class="list-group-item"><a href="{{ url($trend->path) }}">{{ $trend->title }}</a></li>
                        @empty
                            <li class="list-group-item">no data</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div><!-- end of row -->
    </div><!-- end of container -->
@endsection
