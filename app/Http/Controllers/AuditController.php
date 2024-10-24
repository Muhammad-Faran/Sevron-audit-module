<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->paginate(20);

        return view('audits.index', compact('audits'));
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);

        return view('audits.show', compact('audit'));
    }
}
