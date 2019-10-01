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
                    <div class="card-body">
                        <div class="card-title">Search</div>
                        <form action="/threads/search" method="get">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." name="q" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div><!-- end of search card -->

                @if(count($trending))
                    <div class="card">
                        <div class="card-header">
                            Trending Threads
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($trending as $trend)
                                <li class="list-group-item"><a href="{{ url($trend->path) }}">{{ $trend->title }}</a>
                                </li>
                            @empty
                                <li class="list-group-item">no data</li>
                            @endforelse
                        </ul>
                    </div>
                @endif

            </div>

        </div><!-- end of row -->

    </div><!-- end of container -->
@endsection
