<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DomainRecord;

class DomainRecordController extends Controller
{
    public function index(Request $request) {
        $records = DomainRecord::select();

        $options = [
            'domain' => '域名',
            'company' => '主办单位',
            'license' => '备案号',
            'website' => '网站名称',
        ];

        $input = $request->all();
        if ($request->has('type') && $request->has('keywords')) {
            $field = trim($input['type']);
            $value = '%' . trim($input['keywords']) . '%';
            if (in_array($field, array_keys($options))) {
                $records = $records->where($field, 'like', $value);
            }
        }
        $records = $records->orderby('time', 'DESC')->paginate(50);
        $request->flash();

        return view('records', compact('records', 'options'));
    }
}
