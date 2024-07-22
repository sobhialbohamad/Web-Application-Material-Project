<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\file;
use App\Models\User;
use App\Models\user_group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FileController extends Controller

{

     public function index()
{

    $files = \App\Models\file::all();
     $pendingUsers = User::where('status', 'pending')->get();
     $users_account = User::with('groups')->get();
  
return view('Admin.dashboard', ['files' => $files,'users'=>$pendingUsers,'users_account'=>$users_account]);
}

public function userindex()
{

  $user = Auth::user();

      $groupIds = $user->groups->pluck('id')->toArray();
      $files = file::whereIn('group_id', $groupIds)->get();

          if ($files->isNotEmpty()) {
              return view('User.dashboard', ['files' => $files]);
          } else {
            return view('User.dashboard');
          }
        }




public function download($filename)
{
    $file = file::where('filename', $filename)->first();

    if (!$file) {
        abort(404);
    } elseif ($file->status === 'reserved') {
        return redirect()->back()->with('warning', 'File is already reserved and cannot be downloaded.');
    }

    DB::beginTransaction();

    try {
        $file->status = 'reserved';
        $file->save();
        $file->incrementDownloads();

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();

        return response()->json(['error' => 'An error occurred during file processing'], 500);
    }

    $headers = [
        'Content-Type' => 'application/octet-stream',
        'Content-Disposition' => "attachment; filename={$file->filename}",
    ];

    return response()->make($file->content, 200, $headers);
}




public function uploaduser(Request $request)
{
  $request->validate([
      'file' => 'required|mimes:txt|max:2048',
  ]);

  $file = $request->file('file');

  $user = Auth::user();
  $user_group = user_group::where('user_id', $user->id)->first();
 $groupId = $user_group ? $user_group->group_id : null;

  $existingFile = file::where('filename', $file->getClientOriginalName())->first();

  if ($existingFile) {
      Storage::disk('public')->delete("uploads/{$existingFile->filename}");

      $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

      $content = file_get_contents($file->getRealPath());

      $existingFile->update([
          'content' => $content,
          'user_id' => $user->id,
          'group_id' => $groupId,
          'status' => 'free',
      ]);
  } else {
      $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

      $content = file_get_contents($file->getRealPath());

      $textFile = new file([
          'filename' => $file->getClientOriginalName(),
          'content' => $content,
          'user_id' => $user->id,
          'group_id' => $groupId,
          'status' => 'free',
      ]);
      $textFile->save();
  }


  if ($groupId == 1) {
      $files = file::where('group_id', $groupId)->get()->all();
      return back();
  }

  if ($groupId == 2) {
      $files = file::where('group_id', $groupId)->get();
      return back();
  }
}



                       public function uploadadmin(Request $request)
                       {
                         $request->validate([
                             'file' => 'required|mimes:txt|max:2048',
                         ]);

                         $file = $request->file('file');

                         $user = Auth::user();
                         $user_group = user_group::where('user_id', $user->id)->first();
   $groupId = $user_group ? $user_group->group_id : null;

                         $existingFile = file::where('filename', $file->getClientOriginalName())->first();

                         if ($existingFile) {
                             Storage::disk('public')->delete("uploads/{$existingFile->filename}");

                             $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

                             $content = file_get_contents($file->getRealPath());

                             $existingFile->update([
                                 'content' => $content,
                                 'user_id' => $user->id,
                                 'group_id' => $groupId,
                                 'status' => 'free',
                             ]);
                         } else {
                             $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

                             $content = file_get_contents($file->getRealPath());

                             $textFile = new file([
                                 'filename' => $file->getClientOriginalName(),
                                 'content' => $content,
                                 'user_id' => $user->id,
                                 'group_id' => $groupId,
                                 'status' => 'free',
                             ]);
                             $textFile->save();
                         }
                         return back();
                       }



public function downloadMultiple(Request $request)
{
    $filenames = $request->input('selectedFiles');

    if (empty($filenames)) {
        return response()->json(['error' => 'No files selected'], 400);
    }
    foreach ($filenames as $key ) {
      $data=file::where('id',$key )->first();

      if ($data->status === 'reserved') {
         return redirect()->back()->with('warning', 'File is already reserved and cannot be downloaded.');
     }
    }



    $files = file::whereIn('id', $filenames)
                 ->where('status', 'free')
                 ->get();

    $zip = new ZipArchive();
    $zipFileName = 'downloads_1704478359.zip';
    $zipPath = public_path($zipFileName);

    if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

        DB::beginTransaction();

        try {
            foreach ($files as $file) {
                $zip->addFromString($file->filename, $file->content);
                $file->status = 'reserved';
                $file->save();
                $file->incrementDownloads();
            }
            $zip->close();


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'An error occurred during file processing'], 500);
        }

    } else {
        return response()->json(['error' => "Zip creation failed: " . $zip->getStatusString()], 500);
    }

    $headers = [
        'Content-Type' => 'application/zip',
        'Content-Disposition' => "attachment; filename={$zipFileName}",
    ];

    return response()->make($zipFileName, 200, $headers);
}

public function approveUser($userId) {

  $auth=Auth::user();
  $user_group = user_group::where('user_id', $auth->id)->first();
 $groupId = $user_group ? $user_group->group_id : null;
  //  dd($groupId);
  $user = User::findOrFail($userId);
  $user->status = 'approve';
  $user->save();
  $group=user_group::create([
    'user_id'=>$user->id,
    'group_id'=>$groupId,
  ]);
  return back();
}

public function rejectUser($userId) {
  $user = User::findOrFail($userId);
  $user->status = 'pending';
  $user->save();
    return back();
}
}
