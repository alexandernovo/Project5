<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use App\Models\WasteCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class WasteCollectController extends Controller
{
    public function wastecollect_view()
    {
        return view('wastecollect.views.wastecollect');
    }

    public function save_new_wastecollect(Request $request)
    {
        try {
            DB::beginTransaction();

            $all = $request->all();
            $wastecollect_id = $all['wastecollect_id'];
            unset($all['wastecollect_id']);

            if ($wastecollect_id == 0) {
                WasteCollection::create($all);
            } else {
                WasteCollection::where("wastecollect_id", $wastecollect_id)->update($all);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "Waste Collection saved successfully"
            ]);
        } catch (Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function getwastecollects(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $searchValue = $request->input('search.value');
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');

        $query = DB::table('wastecollection')
            ->select('*', DB::raw('(recyclable + biodegradable + nonbio + specialwaste) AS total'));

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('wastecollection.barangay', 'like', "%{$searchValue}%")
                    ->orWhere('wastecollection.province', 'like', "%{$searchValue}%")
                    ->orWhere('wastecollection.municipality', 'like', "%{$searchValue}%")
                    ->orWhere('wastecollection.purok', 'like', "%{$searchValue}%");
            });
        }

        if (!empty($dateFrom) && !empty($dateTo)) {
            $dateFrom = date("Y-m-d", strtotime($dateFrom));
            $dateTo = date("Y-m-d", strtotime($dateTo));
            $query->where(DB::raw("CAST(wastecollection.created_at AS DATE)"), ">=", $dateFrom)
                ->where(DB::raw("CAST(wastecollection.created_at AS DATE)"), "<=", $dateTo);
        }

        $totalData = $query->count();

        $data = $query
            ->offset($start)
            ->limit($length)
            ->get();

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        ]);
    }

    public function deletewastecollect(Request $request)
    {
        $wastecollect_id = $request->wastecollect_id;

        WasteCollection::where('wastecollect_id', $wastecollect_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Waste Collection Record deleted successfully"
        ]);
    }
}
