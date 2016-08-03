<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DomainRecord;

class DomainRecordController extends Controller
{
    public function index() {
        $records = DomainRecord::orderby('time', 'DESC')->paginate(50);

        return view('records', compact('records'));
    }
}
