<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Repository\AdminRepo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        return response()->json(AdminRepo::users());
    }

    public function create(Request $request)
    {
//        $fields = $request->validate([]);
    }

    public function index()
    {
        return response()->json(AdminRepo::habits());
    }
}
