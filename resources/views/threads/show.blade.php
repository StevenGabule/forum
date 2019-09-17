@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="text-capitalize">{{ $thread->title }} <br>
                                <small class="small">Posted by: <a
                                        href="/profiles/{{ $thread->creator->name }}"
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

                    <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

                    @if(auth()->check())
                        <form action="{{ $thread->path() . '/replies' }}" method="post" class="mt-3">
                            @csrf
                            <div class="form-group">
                            <textarea name="body" id="body" cols="" rows="5" class="form-control"
                                      placeholder="Have something to saay?"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Post</button>
                        </form>
                    @else
                        <p class="text-center">Please <a href="/login">sign in</a> to participate in the discussion.</p>
                    @endif
                </div><!-- end of col-md-8 -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="#">{{ $thread->creator->name }}</a>, and currently
                                has <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- end of row -->
        </div><!-- end of container -->
    </thread-view>
@endsection
