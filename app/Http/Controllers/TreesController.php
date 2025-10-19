<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TreesController extends Controller
{
    public function trees_view()
    {
        return view('trees.views.trees');
    }

    public function save_new_trees(Request $request)
    {
        try {
            DB::beginTransaction();

            $all = $request->all();
            $record_id = $all['record_id'];
            unset($all['record_id']);

            if ($all['client_id'] == 0) {
                // Create new client
                $client = Client::create([
                    "firstname" => $all['firstname'],
                    "middlename" => $all['middlename'],
                    "lastname" => $all['lastname'],
                    "barangay" => $all['barangay'],
                    "municipality" => $all['municipality'],
                    "province" => $all['province'],
                    "sex" => $all['sex'],
                    "contact_no" => $all['contact_no'],
                ]);

                $client_id = $client->client_id;
            } else {
                $client_id = $all['client_id'];
                Client::where('client_id', $client_id)->update([
                    "firstname" => $all['firstname'],
                    "middlename" => $all['middlename'],
                    "lastname" => $all['lastname'],
                    "barangay" => $all['barangay'],
                    "municipality" => $all['municipality'],
                    "province" => $all['province'],
                    "sex" => $all['sex'],
                    "contact_no" => $all['contact_no'],
                ]);
            }

            unset($all['client_id'], $all['firstname'], $all['middlename'], $all['lastname'], $all['barangay'], $all['municipality'], $all['province'], $all['sex'], $all['contact_no']);
            $all['client_id'] = $client_id;

            if ($record_id == 0) {
                $all['status'] = "ACTIVE";
                $all['type'] = "TREES";
                Record::create($all);
            } else {
                Record::where("record_id", $record_id)->update($all);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "Trees saved successfully"
            ]);
        } catch (Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function gettreess(Request $request)
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
            )
            ->where("records.type", "TREES");

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
            ->get();

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        ]);
    }

    public function deletetrees(Request $request)
    {
        $record_id = $request->record_id;

        Record::where('record_id', $record_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Cutting Trees deleted successfully"
        ]);
    }

    public function printTrees(Request $request)
    {
        $record_id = $request->query("record_id");

        $record = DB::table('records')
            ->leftJoin('clients', 'records.client_id', '=', 'clients.client_id')
            ->select(
                'records.*',
                'clients.*',
                DB::raw("clients.firstname + ' '+ clients.middlename+' '+ clients.lastname AS owner_name"),
                DB::raw("'Brgy. ' + clients.barangay + ', '+ clients.municipality+', '+ clients.province AS address")
            )
            ->where("records.type", "TREES")
            ->where("records.record_id", $record_id)->first();

        return view('trees.views.printtrees', ['record' => $record]);
    }
}
