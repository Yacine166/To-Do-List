@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">App ToDo List</div>

                <div class="card-body">
                <a href="{{ route('todos.index') }}" class="btn btn-sm btn-info" style="font-size: 20px;">&larr; </a>
                Back<br><br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('todos.save') }}">
                        @csrf
                        <div class="form-group">
                            <label class="from-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title">
                            <small id="emailHelp" class="form-text text-muted">this is small description of title
                            </small>
                        </div>
                        <div class="form-group">
                            <label class="from-label">Description</label>
                            <textarea name="description" class="form-control" cols="5" rows="5"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="text-center">

                            <button type="submit" class="btn btn-primary justify-center">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection