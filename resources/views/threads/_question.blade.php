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

    <div class="card-footer">
        <button class="btn btn-info" @click="editing = true">Edit</button>
    </div>

</div><!-- end of 1st card -->
