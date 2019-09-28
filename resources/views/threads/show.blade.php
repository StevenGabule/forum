@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/vendor/jquery.atwho.css') }}">
    <script>
        window.thread = <?= json_encode($thread); ?>
    </script>
@endsection
@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <img src="{{ $thread->creator->avatar_path }}" alt="" width="100" height="100">
                            <h3 class="text-capitalize">{{ $thread->title }} <br>
                                <small class="small">
                                    Posted by: <a href="/profiles/{{ $thread->creator->name }}"
                                                  class="text-capitalize">{{ $thread->creator->name }}</a>
                                </small>
                            </h3>
                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div><!-- end of 1st card -->

                    <replies @added="repliesCount++" @removed="repliesCount--"></replies>

                </div><!-- end of col-md-8 -->

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="#">{{ $thread->creator->name }}</a>, and currently
                                has <span
                                    v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                            </p>
                            <p>
                                <subscribe-button
                                    :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- end of row -->
        </div><!-- end of container -->
    </thread-view>
@endsection
