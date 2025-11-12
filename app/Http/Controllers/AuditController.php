<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
<<<<<<< HEAD
        $this->middleware('admin');
=======
        // Remove this line:
        // $this->middleware('admin');
        
        // The route already has role middleware, so this is redundant
>>>>>>> 54ab4ca (Ready for Debugging)
    }

    public function index(Request $request)
    {
        $query = AuditLog::with('user');
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                $request->get('start_date'),
                $request->get('end_date')
            ]);
        }
        
        if ($request->has('action')) {
            $query->where('action', $request->get('action'));
        }
        
        if ($request->has('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }
        
        $logs = $query->orderBy('created_at', 'desc')->paginate(50);
        
        return view('audit.index', compact('logs'));
    }
}