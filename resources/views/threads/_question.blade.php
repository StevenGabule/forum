{{-- Editing the quesiton--}}
<div class="card" v-if="editing">

    <div class="card-header">

        <div class="form-group">
            <label for="Title">Title:</label>
            <input type="text" class="form-control" id="Title" v-model="form.title">
        </div>

    </div>

    <div class="card-body">
        <textarea rows="10" class="form-control" v-model="form.body"></textarea>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <div>
            <button class="btn btn-info" @click="editing = true" v-show="!editing">Edit</button>
            <button class="btn btn-primary" @click="update">Update</button>
            <button class="btn btn-link" @click="resetForm">Cancel</button>
        </div>

        @can('update', $thread)
            <form action="{{$thread->path() }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link">Delete thread</button>
            </form>
        @endcan
    </div>

</div><!-- end of 1st card -->


{{-- Viewing the quesiton--}}
<div class="card" v-else>

    <div class="card-header d-flex justify-content-between">

        <img src="{{ $thread->creator->avatar_path }}" alt="" width="100" height="100">

        <h3 class="text-capitalize">
            <span v-text="title"></span><br>
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

    <div class="card-body" v-text="body"></div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-info" @click="editing = true">Edit</button>
    </div>

</div><!-- end of 1st card -->
