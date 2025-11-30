<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use App\Models\WasteBottle;
use App\Models\wastebottleion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class WasteBottleController extends Controller
{
    public function wastebottle_view()
    {
        return view('wastebottle.views.wastebottle');
    }

    public function save_new_wastebottle(Request $request)
    {
        try {
            DB::beginTransaction();

            $all = $request->all();
            $wastebottle_id = $all['wastebottle_id'];
            unset($all['wastebottle_id']);

            if ($wastebottle_id == 0) {
                WasteBottle::create($all);
            } else {
                WasteBottle::where("wastebottle_id", $wastebottle_id)->update($all);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "Waste in the Bottle Record saved successfully"
            ]);
        } catch (Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function getwastebottles(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $searchValue = $request->input('search.value');
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');

        $query = DB::table('wastebottle')
            ->select('*', DB::raw('(bottleinkg + riceinkg) AS total'));

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('wastebottle.brgy', 'like', "%{$searchValue}%")
                    ->orWhere('wastebottle.province', 'like', "%{$searchValue}%")
                    ->orWhere('wastebottle.municipality', 'like', "%{$searchValue}%")
                    ->orWhere('wastebottle.purok', 'like', "%{$searchValue}%");
            });
        }

        if (!empty($dateFrom) && !empty($dateTo)) {
            $dateFrom = date("Y-m-d", strtotime($dateFrom));
            $dateTo = date("Y-m-d", strtotime($dateTo));
            $query->where(DB::raw("CAST(wastebottle.created_at AS DATE)"), ">=", $dateFrom)
                ->where(DB::raw("CAST(wastebottle.created_at AS DATE)"), "<=", $dateTo);
        }

        $totalData = $query->count();

        $data = $query
            ->orderBy("wastebottle.created_at", "DESC")
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


    public function deletewastebottle(Request $request)
    {
        $wastebottle_id = $request->wastebottle_id;

        WasteBottle::where('wastebottle_id', $wastebottle_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Waste Bottle Record deleted successfully"
        ]);
    }
}
