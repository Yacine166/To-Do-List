@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('todos.index') }}" class="btn btn-sm btn-info" style="font-size: 20px;">&larr; </a>
                    Back<br>
                    <div class="card text-center">
                        <div class="card-header">
                            Details
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Completed</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input id="getTitle" type="text" class="form-control" name="title"
                                            placeholder="Enter Title" value="{{ $todo->title }}">
                                    </td>
                                    <td>
                                        <input id="getDesc" type="text" class="form-control" name="title"
                                            placeholder="Enter Title" onchange="changeDescription()"
                                            value="{{ $todo->description }}">
                                    </td>
                                    <td>
                                        <button id="btn_toggle" type="button"
                                            onclick="toggleStatus({{ $todo->id }}, this)"
                                            class="btn btn-sm {{ $todo->is_completed ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $todo->is_completed ? 'Completed' : 'In Completed' }}
                                        </button>
                                    </td>
                                    <td id="outer">
                                        <form action="{{ route('todos.delete', $todo->id)}}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="margin: 20px auto;">
                            @csrf
                            @method('PUT')
                            <input id="inputTitle" type="hidden" name="title" value="{{ $todo->title }}">
                            <input id="inputDescr" type="hidden" name="description" value="{{ $todo->description }}"> 
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </form>

                        <div class="card-footer text-muted">
                            Lasrt Edit {{ $todo->updated_at->diffForHumans() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection