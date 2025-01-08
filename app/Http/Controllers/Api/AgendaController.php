<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\MUser;
use App\Models\MAgenda;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{
    public function Test(Request $request)
    {
        $test = DB::table('m_siswa')
            ->get();

        $testToArray = $test->toArray();

        if ($testToArray !== []) {
            return response()->json([
                'code' => 200,
                'dataSiswa' => $testToArray
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada data siswa'
            ], 200);
        }

    }
}