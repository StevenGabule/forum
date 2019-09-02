@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form action="/threads" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title...">
                            </div>
                            <div class="form-group">
                                <textarea name="body" class="form-control" id="body" cols="" rows="8" placeholder="Description..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Published</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
