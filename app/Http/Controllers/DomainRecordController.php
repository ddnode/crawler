<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DomainRecord;

class DomainRecordController extends Controller
{
    public function index(Request $request) {
        $records = DomainRecord::orderby('time', 'DESC')->paginate(50);

        $input = $request->all();
        if ($request->has('domain')) {
          $domain = trim($input['domain']);
          $records = DomainRecord::where('domain', $domain)->orderby('time', 'DESC')->paginate(50);
        }

        return view('records', compact('records'));
    }
}
