<?php
namespace App\Http\Controllers;
use App\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $data = Tasks::latest()
            ->where('user_id',$user_id)->paginate(10);
        return view('tasks', compact('data'))
            ->with('i', (request()->input('page',1) -1) *10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        $user_id = $user->id;
        $request->validate([
            'task_name' => 'required',
        ]);

        $form_data = array(
            'name' => $request->task_name,
            'description' => $request->task_description,
            'user_id' => $user_id,
            'is_complete' => false
        );

//        print_r($form_data);
//        exit;

        Tasks::create($form_data);
        return redirect('tasks')->with('success', 'Task added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Tasks::findOrFail($id);
        return view('edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $request->validate([
            'task_name' => 'required',
        ]);

        $form_data = array(
            'name' => $request->task_name,
            'description' => $request->task_description,
            'user_id' => $user_id,
            'is_complete' => 0
        );
        Tasks::whereId($id)->update($form_data);
        return redirect('tasks')->with('success','Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Tasks::findOrFail($id);
        $data->delete();
        return redirect('tasks')->with('success','Data is successfully deleted');
    }

    public function complete($id)
    {

        $form_data = array(
            'is_complete' => 1
        );
        Tasks::whereId($id)->update($form_data);
        return redirect('tasks')->with('success','Data is successfully updated');
    }
}
