<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use Illuminate\Http\Request;

class AccessLogController extends Controller
{
    public function index()
    {
        $logs = AccessLog::orderBy('created_at', 'desc')
            ->paginate(50); // 50 logs por página

        return response()->json($logs);
    }
}
