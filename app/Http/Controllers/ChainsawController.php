<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ChainsawController extends Controller
{
    public function chainsaw_view()
    {
        return view('chainsaw.views.chainsaw');
    }

    public function save_new_chainsaw(Request $request)
    {
        try {
            DB::beginTransaction();

            $all = $request->all();
            $record_id = $all['record_id'];
            unset($all['record_id']);

            if ($all['client_id'] == 0) {
                $client = Client::create([
                    "owner_name" => $all['owner_name'],
                    "address" => $all['address']
                ]);
                $client_id = $client->client_id;
            } else {
                $client_id = $all['client_id'];
                Client::where('client_id', $client_id)->update([
                    "owner_name" => $all['owner_name'],
                    "address" => $all['address']
                ]);
            }

            unset($all['client_id'], $all['owner_name'], $all['address']);
            $all['client_id'] = $client_id;

            if ($record_id == 0) {
                $all['status'] = "ACTIVE";
                $all['type'] = "CHAINSAW";
                Record::create($all);
            } else {
                Record::where("record_id", $record_id)->update($all);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "Chainsaw saved successfully"
            ]);
        } catch (Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function getChainsaws(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $searchValue = $request->input('search.value');

        $query = DB::table('records')
            ->leftJoin('clients', 'records.client_id', '=', 'clients.client_id')
            ->select('records.*', 'clients.*')
            ->where("records.type", "CHAINSAW");

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('clients.owner_name', 'like', "%{$searchValue}%")
                    ->orWhere('clients.address', 'like', "%{$searchValue}%")
                    ->orWhere('records.name_other', 'like', "%{$searchValue}%")
                    ->orWhere('records.record_id', 'like', "%{$searchValue}%");
            });
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

    public function deletechainsaw(Request $request)
    {
        $record_id = $request->record_id;

        Record::where('record_id', $record_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Chainsaw deleted successfully"
        ]);
    }
}
