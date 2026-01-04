<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TricycleController extends Controller
{
    protected $certificationController;

    public function __construct(CertificationController $certificationController)
    {
        $this->certificationController = $certificationController;
    }
    public function tricycle_view()
    {
        return view('tricycle.views.tricycle');
    }

    public function save_new_tricycle(Request $request)
    {
        try {
            DB::beginTransaction();

            $all = $request->all();
            $record_id = $all['record_id'];
            unset($all['record_id']);

            if ($all['client_id'] == 0) {
                $client = Client::create([
                    "firstname" => $all['firstname'],
                    "middlename" => $all['middlename'],
                    "lastname" => $all['lastname'],
                    "barangay" => $all['barangay'],
                    "municipality" => $all['municipality'],
                    "province" => $all['province'],
                    "sex" => $all['sex'],
                    "contact_no" => $all['contact_no'],
                    "date_renewal" => $all['date_renewal'] ?? now(),
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
                $all['type'] = "TRICYCLE";
                Record::create($all);
            } else {
                Record::where("record_id", $record_id)->update($all);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "tricycle saved successfully"
            ]);
        } catch (Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function gettricycles(Request $request)
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
            ->where("records.type", "TRICYCLE")
            ->orderBy("records.created_at", "DESC");

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

    public function deletetricycle(Request $request)
    {
        $record_id = $request->record_id;

        Record::where('record_id', $record_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Tricycle deleted successfully"
        ]);
    }

    public function printTricycle(Request $request)
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
            ->where("records.type", "TRICYCLE")
            ->where("records.record_id", $record_id)->first();

        $certification = DB::table("certification")->where("record_id", $record_id)->first();

        $badges = [
            ['label' => 'Address', 'value' => ':address', 'key' => 'address'],
            ['label' => 'Year', 'value' => ':year', 'key' => 'year'],
            ['label' => 'Owner Name', 'value' => ':OWNER_NAME', 'key' => 'OWNER_NAME'],
            ['label' => 'Month', 'value' => ':month', 'key' => 'month'],
            ['label' => 'Day', 'value' => ':day', 'key' => 'day'],
            ['label' => 'OR Number', 'value' => ':or_number', 'key' => 'ornumber'],
            ['label' => 'Created Date', 'value' => ':created_at', 'key' => 'created_at'],
        ];

        $date = \Carbon\Carbon::parse($record->created_at ?? now());

        $recordData = [
            'year' => $date->format('Y'),
            'month' => $date->format('F'),
            'day' => $date->format('j'),
            'OWNER_NAME' => $record->owner_name ?? '',
            'address' => $record->address ?? '',
            'ornumber' => $record->ornumber ?? '',
            'created_at' => \Carbon\Carbon::parse($record->created_at ?? now())->format('F d, Y'),
        ];

        $description =  $this->certificationController->replacePlaceholders($certification->description ?? '', $badges, $recordData);
        $signatory =  $this->certificationController->replacePlaceholders($certification->signatory ?? '', $badges, $recordData);
        $ornodescription =  $this->certificationController->replacePlaceholders($certification->ornodescription ?? '', $badges, $recordData);

        return view('tricycle.views.printcertification', [
            'record' => $record,
            'description' => $description,
            'signatory' => $signatory,
            'ornodescription' => $ornodescription,
        ]);
    }
}
