@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($threads as $thread)
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ $thread->path() }}" class="text-capitalize">
                                        @if(auth()->check() && $thread->hasUpdateFor(auth()->user()))
                                            <strong>{{ $thread->title }}</strong>
                                        @else
                                            {{ $thread->title }}
                                        @endif
                                    </a>
                                </div>
                                <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="body">{{ $thread->body }}</div>
                        </div><!-- end of card body -->
                    </div><!-- end of card -->
                @empty
                    <p class="text-center">There are no relevant results at this time.</p>
                @endforelse
            </div><!-- end of col-md-8 -->
        </div><!-- end of row -->
    </div><!-- end of container -->
@endsection
