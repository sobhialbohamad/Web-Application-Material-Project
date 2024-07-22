<?php

namespace App\Http\Controllers;

use App\Models\user_group;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
  public function addUserToGroup(Request $request)
{
    $id = $request->user_id;

    // Check if the user is already in group 1
    $inGroup1 = user_group::where('user_id', $id)->where('group_id', 1)->exists();

    // Check if the user is already in group 2
    $inGroup2 = user_group::where('user_id', $id)->where('group_id', 2)->exists();

    // Add the user to group 2 if they are not in group 1
    if (!$inGroup1) {
        $user = user_group::create([
            'user_id' => $id,
            'group_id' => 1,
        ]);
    }
    // Add the user to group 1 if they are not in group 2
    elseif (!$inGroup2) {
        $user = user_group::create([
            'user_id' => $id,
            'group_id' => 2,
        ]);
    }

    return back();
}

}
