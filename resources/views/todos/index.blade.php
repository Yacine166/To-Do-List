@extends('layouts.app')

@section('styles')
<style>
    #outer {
        text-align: center;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ToDo List</div>
                <div style="text-align: end; margin: 20px;">
                    <a href="{{ route('todos.create' )}}"
                        class="d-inline-block btn btn-sm btn-info"> Add</a>
                </div>
                <div class="card-body">
                    @if (Session::has('alert-success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('alert-success') }}
                        </div>
                    @endif 
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (count($listTodo) > 0)
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
                                @foreach ($listTodo as $element)
                                    <tr>
                                        <td>{{ $element->title }}</td>
                                        <td>{{ $element->description }}</td>
                                        <td>
                                            <button id="btn_toggle" type="button"
                                                onclick="toggleStatus({{ $element->id }}, this)"
                                                class="btn btn-sm {{ $element->is_completed ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $element->is_completed ? 'Completed' : 'In Completed' }}
                                            </button>
                                        </td>
                                        <td id="outer">
                                            <a href="{{ route('todos.edit', $element->id) }}"
                                                class="d-inline-block btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('todos.delete', $element->id) }}" method="post"
                                                class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="todo_id" value="{{ $element->id }}">
                                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4>There is no To Do </h4>
                    @endif


                </div>
        </div>
    </div>
</div>
</div>
@endsection