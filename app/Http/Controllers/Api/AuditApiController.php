<?php

// app/Http/Controllers/Api/AuditApiController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class AuditApiController extends Controller
{
    public function index(Request $request)
    {
        $audits = Audit::orderBy('created_at', 'desc')->paginate(20);

        return response()->json($audits);
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);

        return response()->json($audit);
    }
}
