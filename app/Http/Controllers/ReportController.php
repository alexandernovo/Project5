<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
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
}
