<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Task extends Model
{

	public function user(){

		return $this->belongsTo(User::class);

	}

	public function status(){

		return $this->belongsTo(Status::class);

	}







}
