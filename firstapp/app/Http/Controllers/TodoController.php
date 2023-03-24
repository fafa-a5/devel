<?php

namespace App\Http\Controllers;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
   {
    $todos = Todo::all();
    return view('todos.index', [
        'todos' => $todos
        
    ]);
   }
   public function create()
    {
        return view('todos.create');
    }
    public function store(TodoRequest $request)
    {
      // $request->validated();
        Todo::create([
        'title' => $request->title,
        'description' => $request->description,
        'is_completed' =>0
        
        ]);
        $request->session()->flash('alert-success','Todo created successfully');
        return to_route('todos.index');
    }
    public function show($id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            request()->session()->flash('error','Unable to locate the todo');
            return to_route('todos.index')->withErrors([
                'errors' => 'Unable to locate the todo'
            ]);
        }
        return view('todos.show',['todo' => $todo]);
    
    }
    public function edit($id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            request()->session()->flash('error','Unable to locate the todo');
            return to_route('todos.index')->withErrors([
                'errors' => 'Unable to locate the todo'
            ]);
        }
        return view('todos.edit',['todo' => $todo]);
    }
public function update(TodoRequest $request)
{
    $todo = Todo::find($request->todo_id);
    if(!$todo){
        request()->session()->flash('error','Unable to locate the todo');
        return to_route('todos.index')->withErrors([
            'errors' => 'Unable to locate the todo'
        ]);
    }
     
    $todo->update([
        'title' =>$request->title,
        'description' =>$request->description,
        'is_completed' =>$request->is_completed,
        ]);
    $request->session()->flash('alert-info','Todo Updated successfully');
    return to_route('todos.index');
    
}
public function destroy(Request $request)
{
   // dd($request->todo_id);
    $todo = Todo::find($request->todo_id);
    if(!$todo){
        request()->session()->flash('error','Unable to locate the todo');
        return to_route('todos.index')->withErrors([
            'errors' => 'Unable to locate the todo'
        ]);
        
    }
    $todo->delete();
    $request->session()->flash('alert-success','Todo Deleted successfully');
        return to_route('todos.index');
}

}

