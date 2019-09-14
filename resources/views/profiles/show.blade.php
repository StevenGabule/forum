@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-capitalize">
                    {{ $profileUser->name }}
                    <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>

                @foreach($threads as $thread)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}</div>
                            <div>
                                {{ $thread->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{ $thread->body }}</p>
                        </div>
                    </div>
                @endforeach
                {{ $threads->links() }}
            </div>
        </div>
    </div>
@endsection
