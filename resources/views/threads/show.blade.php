@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/vendor/jquery.atwho.css') }}">
@endsection

@section('content')
    <thread-view :thread="{{ $thread }}" inline-template>

        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    @include('threads._question')

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
                                    :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>
                                <button class="btn btn-danger" v-if="authorize('isAdmin')"  @click="ToggleLock" v-text="locked ? 'Unlock' : 'Lock'">Lock</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- end of row -->
        </div><!-- end of container -->
    </thread-view>
@endsection
