<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard_view()
    {
        return view('dashboard.views.dashboard');
    }

    public function getDashboardDetails(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $searchValue = $request->input('search.value');
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');

        $query = DB::table('records')
            ->leftJoin('clients', 'records.client_id', '=', 'clients.client_id')
            ->select(
                'records.*',
                'clients.*',
                DB::raw("clients.firstname + ' '+ clients.middlename+' '+ clients.lastname AS owner_name"),
                DB::raw("clients.barangay + ', '+ clients.municipality+', '+ clients.province AS address")
            );

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where(DB::raw("CONCAT(clients.firstname, ' ', clients.middlename, ' ', clients.lastname)"), 'like', "%{$searchValue}%")
                    ->orWhere(DB::raw("CONCAT(clients.barangay, ', ', clients.municipality, ', ', clients.province)"), 'like', "%{$searchValue}%")
                    ->orWhere('ornumber', 'like', "%{$searchValue}%");
            });
        }

        if (!empty($dateFrom) && !empty($dateTo)) {
            $dateFrom = date("Y-m-d", strtotime($dateFrom));
            $dateTo = date("Y-m-d", strtotime($dateTo));
            $query->where(DB::raw("CAST(records.created_at AS DATE)"), ">=", $dateFrom)
                ->where(DB::raw("CAST(records.created_at AS DATE)"), "<=", $dateTo);
        }

        $totalData = $query->count();

        $data = $query
            ->offset($start)
            ->limit($length)
            ->get()
            ->map(function ($row) {
                $row->chainsawTableRequirements = DB::table('requirements')
                    ->where('record_id', $row->record_id)
                    ->orderBy("created_at", "DESC")
                    ->get();
                    
                $row->treesTableRequirements = DB::table('requirements')
                    ->where('record_id', $row->record_id)
                    ->orderBy("created_at", "DESC")
                    ->get();
                return $row;
            });

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        ]);
    }

    // public function getChartData(Request $request)
    // {
    //     $year = $request->get('year', now()->year);

    //     $records = DB::table('records')
    //         ->selectRaw("
    //         DATENAME(MONTH, created_at) as month,
    //         MONTH(created_at) as month_num,
    //         type,
    //         COUNT(*) as total
    //     ")
    //         ->whereYear('created_at', $year)
    //         ->groupByRaw('DATENAME(MONTH, created_at), MONTH(created_at), type')
    //         ->orderBy('month_num')
    //         ->get();

    //     // Keep only the highest total per month
    //     $filtered = $records->groupBy('month')->map(function ($items) {
    //         return $items->sortByDesc('total')->first();
    //     })->values();

    //     return response()->json($filtered);
    // }
    public function getChartData(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', 'all');

        $query = DB::table('records')
            ->selectRaw("type, COUNT(*) as total")
            ->whereYear('created_at', $year);

        if ($month !== 'all') {
            $query->whereMonth('created_at', $month);
        }

        $records = $query
            ->groupBy('type')
            ->orderBy('type')
            ->get();

        return response()->json($records);
    }

    public function getDashboardCounts(Request $request)
    {
        $counts = DB::table('records')
            ->select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->orderBy('type')
            ->get();

        return response()->json([
            "status" => "success",
            "counts" => $counts
        ]);
    }
}
