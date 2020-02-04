<?php

namespace App\Http\Controllers;

use App\Status;
use App\Task;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

	public function index(){

		//iran kcacner@
		$attachedTasks = Auth::user()->tasks;


		//ir kcacner@ urish useri kam iren

		// $attachedTasks = Auth::user()->tasks[0]['to_user'];

		$myTasks = Task::where('to_user',auth()->id())->get();

		return view('user.tasks.index', compact(['myTasks','attachedTasks']));

	}

	public function create(){

		$users = User::where('userRole','user')->get();

		return view('user.tasks.create', compact(['users']));

	}


	public function store(Request $request) {

		$data = $request->validate([
		 	'title'       => 'required|min:5',
		 	'description' => 'required|min:10|max:100',
		 	'photo'       => 'required|image',
		 ]);

		$task              = new Task();
		$task->title       = $request->title;
		$task->description = $request->description;
		$task->user_id     = Auth::user()->id;
		$task->to_user     = $request->user;


		if ($request->file('photo')) {

			$image     = $request->file('photo');
			$extension = $image->getClientOriginalExtension();
			$filename  = time() . '.' . $extension;
			Storage::disk('public')->put('/img/' . $filename, File::get($image));
			$task->photo       = $filename;
		}

		$task->save();

		return redirect('user/tasks');
	}



	public function show($id){


	}


	public function edit($id){
		$users = User::where('userRole','user')->get();

		$statuses = Status::all();

		$task = Task::find($id);

		return view('user.tasks.edit', compact(['task','users','statuses']));

	}


	public function update(Request $request, $id){

		$data = $request->validate([
			'title'       => 'required|min:5',
			'description' => 'required|min:10|max:100',
			'photo'       => 'required|image|nullable|max:2000',
			'status'      => 'required'
		]);

		if ($request->hasfile('photo')) {
			$image     = $request->file('photo');
			$extension = $image->getClientOriginalExtension();
			$filename  = time() . '.' . $extension;
			Storage::disk('public')->put('/img/' . $filename, File::get($image));
		} else {
			$filename = 'noimage.jpg';
		}

		$task = Task::find($id);

		$task->title       = $request->title;
		$task->description = $request->description;
		$task->photo       = $filename;
		$task->status_id   = $request->status;
		$task->user_id     = Auth::user()->id;
		$task->to_user     = $request->user;

		$task->save();

		$attachedTasks = Auth::user()->tasks;

		$myTasks = Task::where('to_user',auth()->id())->get();

		return redirect('user/tasks')->with([$myTasks,$attachedTasks]);

	}


	public function destroy($id){


	}






}
