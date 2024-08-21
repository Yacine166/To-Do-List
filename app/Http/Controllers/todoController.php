<?php

namespace App\Http\Controllers;

use App\Http\Requests\todoRequest;
use App\Models\todoModel;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index()
    {
        $listTodo = todoModel::all();
        $argement = ['listTodo' => $listTodo];
        return view('todos.index', $argement);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(todoRequest $request)
    {
        todoModel::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'is_completed' => 0,
            ]
        );

        session()->flash('alert-success', 'ToDo Create Successfully');

        return to_route('todos.index');
    }

    public function edit($id)
    {
        $response = todoModel::findOrFail($id);
        if (!$response) {
            session()->flash('error', 'Unable to locate the view');
            return to_route('todos.index');
        } else
            return view('todos.edit', ['todo' => $response]);
    }

    public function update(Request $request, $id)
    {
        $todo = todoModel::findOrFail($id);  // Find the todo by its ID
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->is_completed = $request->input('is_completed', 0);
        $todo->save();  // Save the changes


        session()->flash('alert-success', 'ToDo Updated Successfully');
        return to_route('todos.index');
    }

    public function destroy($id)
    {

        $todo = todoModel::findOrFail($id);  // Find the todo by its ID
        $todo->delete();


        session()->flash('alert-success', 'ToDo Deleted Successfully  ');
        return to_route('todos.index');
    }

    public function toggleStatus(Request $request, $id)
    {
        $todo = todoModel::findOrFail($id); // Find the todo by its ID
        $todo->is_completed = !$todo->is_completed; // Toggle the completion status
        $todo->save(); // Save the changes

        return response()->json([
            'success' => true,
            'is_completed' => $todo->is_completed
        ]);
    }



}
