<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
  
     public function create()
       {
           return view('groups.create');
       }

       public function store(Request $request)
       {
           $request->validate([
               'name' => 'required|unique:groups|max:255',
           ]);

           Group::create([
               'name' => $request->input('name'),
           ]);

           return redirect()->route('group.create')->with('success', 'Group created successfully!');
       }
   }

}
