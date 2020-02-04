<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Status;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

	public function index(){
		$tasks = Task::all();

		return view('admin.dashboard', compact('tasks'));
	}


	public function edit($id){

		$task = Task::find($id);

		$statuses = Status::all();

		$users = User::where('userRole','user')->get();

		return view('admin.tasks.edit', compact('task','statuses','users'));

	}


	public function update(Request $request, $id){
		$data = $request->validate([
			'title'       => 'required|min:5',
			'description' => 'required|min:10|max:100',
			'photo'       => 'required|image|nullable|max:2000',
			'status'   => 'required'
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
		$task->user_id     = $request->user;
		$task->to_user     = $request->user;

		$task->save();

		$tasks = Task::all();

		return redirect('admin/dashboard')->with('tasks');

	}





}
