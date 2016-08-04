<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DomainRecord;

class DomainRecordController extends Controller
{
    public function index(Request $request) {
        $records = DomainRecord::select();

        $input = $request->all();
        if ($request->has('type') && $request->has('keywords')) {
            $field = trim($input['type']);
            $value = '%' . trim($input['keywords']) . '%';
            if (in_array($field, ['domain', 'company', 'license', 'website'])) {
                $records = $records->where($field, 'like', $value);
            }
        }
        $records = $records->orderby('time', 'DESC')->paginate(50);

        return view('records', compact('records'));
    }
}
