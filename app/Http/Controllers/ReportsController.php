<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestLog;
use App\Models\file;

class ReportsController extends Controller {
    public function fileReport(file $file) {
        return view('reports.file', compact('file'));
    }



    public function showRequestLogs()
  {
      $requestLogs = RequestLog::orderBy('created_at', 'desc')->paginate(10);
      return view('logrequest', compact('requestLogs')); 
  }
}
