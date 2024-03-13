<?php

namespace App\Http\Controllers;

use App\Models\ParseError;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ErrorsController extends Controller
{

    public function store_parse_errors(Request $request)
    {
        $request->validate([
            'errors' => 'required|array',
            'errors.*.link' => 'string',
            'errors.*.error' => 'string',
            'errors.*.count' => 'integer',
        ]);

        $now = Carbon::now('utc')->toDateTimeString();

        $errors = $request->input('errors');
        $errors_with_timestamps = [];

        foreach ($errors as $error){
            $error['created_at'] = $now;
            $error['updated_at'] = $now;
            $errors_with_timestamps[] = $error;
        }
        
        ParseError::insert($errors_with_timestamps);

        return responder()->success()->respond();
    }
}
