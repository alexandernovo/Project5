<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use App\Models\WasteCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ReportController extends Controller
{
    public function reportdashboard()
    {
        return view('reports.views.reportdashboard');
    }

    public function associationPrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "ASSOCIATION");

        $data = [
            'data' => $result
        ];

        return view('reports.views.associationprint', $data);
    }

    public function boatingPrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "BOATING");

        $data = [
            'data' => $result
        ];

        return view('reports.views.boatingprint', $data);
    }

    public function sarisaristorePrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "STORE");

        $data = [
            'data' => $result
        ];

        return view('reports.views.sarisaristoreprint', $data);
    }

    public function tricyclePrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "TRICYCLE");

        $data = [
            'data' => $result
        ];

        return view('reports.views.tricycleprint', $data);
    }

    public function vendorsPrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "VENDOR");

        $data = [
            'data' => $result
        ];

        return view('reports.views.vendorprint', $data);
    }

    public function chainsawPrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "CHAINSAW");

        $data = [
            'data' => $result
        ];

        return view('reports.views.chainsawprint', $data);
    }

    public function treesPrint(Request $request)
    {
        $monthyear = $request->query('monthyear');
        $result = $this->getPrintQuery($monthyear, "TREES");

        $data = [
            'data' => $result
        ];

        return view('reports.views.treesprint', $data);
    }

    private function getPrintQuery($monthyear, $type)
    {
        $query = DB::table('records')
            ->leftJoin('clients', 'records.client_id', '=', 'clients.client_id')
            ->select(
                'records.*',
                'clients.*',
                DB::raw("clients.firstname + ' '+ clients.middlename+' '+ clients.lastname AS owner_name"),
                DB::raw("'Brgy. ' + clients.barangay + ', '+ clients.municipality+', '+ clients.province AS address")
            )
            ->where("records.type", $type);

        if (!empty($monthyear)) {
            $query->whereRaw("FORMAT(records.created_at, 'yyyy-MM') = ?", [$monthyear]);
        }

        $result = $query->get();

        return $result;
    }

    public function wastePrint(Request $request)
    {
        $type_waste = $request->query('type_waste');
        $month_waste = $request->query('month_waste');
        $category_waste = $request->query('category_waste');
        $barangay_waste = $request->query('barangay_waste');

        if ($type_waste == "Collection") {
            $query = DB::table('wastecollection')
                ->select(
                    '*',
                    DB::raw('(recyclable + biodegradable + nonbio + specialwaste) as total')
                )
                ->whereRaw("FORMAT(created_at, 'yyyy-MM') = ?", [$month_waste]);

            if ($category_waste == "Barangay") {
                $query->where('barangay', $barangay_waste);
            }

            $result = $query->get([
                'recyclable',
                'biodegradable',
                'nonbio',
                'specialwaste',
            ])->map(function ($row) {
                foreach (['recyclable', 'biodegradable', 'nonbio', 'specialwaste', 'total'] as $field) {
                    if (isset($row->$field)) {
                        $value = (float)$row->$field;
                        $row->$field = $value == floor($value) ? (int)$value : $value;
                    }
                }
                return $row;
            });

            $totals = [
                'recyclable' => $result->sum('recyclable'),
                'biodegradable' => $result->sum('biodegradable'),
                'nonbio' => $result->sum('nonbio'),
                'specialwaste' => $result->sum('specialwaste'),
            ];

            $totals['grand_total'] = array_sum($totals);

            $data = [
                'data' => $result,
                'totals' => $totals,
            ];

            return view('reports.views.wastecollectionprint',  $data);
        } else {

            $query = DB::table('wastebottle')
                ->select(
                    '*',
                    DB::raw('(bottleinkg) as total')
                )
                ->whereRaw("FORMAT(created_at, 'yyyy-MM') = ?", [$month_waste]);

            if ($category_waste == "Barangay") {
                $query->where('brgy', $barangay_waste);
            }

            $result = $query->get([
                'bottleinkg',
                'riceinkg'
            ])->map(function ($row) {
                foreach (['bottleinkg', 'riceinkg', 'total'] as $field) {
                    if (isset($row->$field)) {
                        $value = (float)$row->$field;
                        $row->$field = $value == floor($value) ? (int)$value : $value;
                    }
                }
                return $row;
            });

            $totals = [
                'bottleinkg' => $result->sum('bottleinkg'),
                'riceinkg' => $result->sum('riceinkg'),
                'grand_total' => $result->sum('bottleinkg'),
            ];

            $data = [
                'data' => $result,
                'totals' => $totals,
            ];

            return view('reports.views.wastebottleprint', $data);
        }
    }
}
