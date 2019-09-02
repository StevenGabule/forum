@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $thread->title }}</h3>
                        <p class="lead">Posted by: <a href="#">{{ $thread->creator->name }}</a></p>
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center mt-4">
                <div class="col-md-8 col-md-offset-2">
                    <form action="{{ $thread->path() . '/replies' }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" cols="" rows="5" class="form-control"
                                      placeholder="Have something to saay?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="/login">sign in</a> to participate in the discussion.</p>
        @endif
    </div>
@endsection
