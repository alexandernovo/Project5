<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificationController extends Controller
{
    public function association_certificate(Request $request)
    {
        $record_id = $request->query("record_id");
        $data = $this->getPrintQuery($record_id, "ASSOCIATION");
        $certificate = DB::table("certification")->where("record_id", $record_id)->first();
        return view('association.views.editprintassociation', ['record' => $data, 'certificate' => $certificate]);
    }

    public function boating_certificate(Request $request)
    {
        $record_id = $request->query("record_id");
        $data = $this->getPrintQuery($record_id, "BOATING");
        $certificate = DB::table("certification")->where("record_id", $record_id)->first();
        return view('boating.views.editprintboating', ['record' => $data, 'certificate' => $certificate]);
    }

    private function getPrintQuery($id, $type)
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

        if (!empty($id)) {
            $query->where("records.record_id", $id);
        }

        $result = $query->first();

        return $result;
    }

    public function saveCertification(Request $request)
    {
        $now = now();
        $data = [
            'description' => $request->description,
            'signatory' => $request->signatory,
            'ornodescription' => $request->ornodescription,
            'updated_at' => $now,
        ];

        $find = DB::table("certification")->where("record_id", $request->record_id)->first();
        if (!$find) {
            $data["created_at"] = $now;
        }

        DB::table("certification")->updateOrInsert(
            ['record_id' => $request->record_id],
            $data
        );

        return response()->json([
            "status" => "success",
        ]);
    }

    public function replacePlaceholders(string $html, array $badges, array $recordData): string
    {
        foreach ($badges as $badge) {
            $placeholder = $badge['value'];
            $value = $recordData[$badge['key']] ?? '';

            // Match <strong ...>PLACEHOLDER</strong> or <span ...>PLACEHOLDER</span>
            $pattern = "/<(strong|span)[^>]*>" . preg_quote($placeholder, '/') . "<\/\\1>/i";

            // Replace with same tag but remove extra attributes
            $replacement = "<$1>" . $value . "</$1>";

            $html = preg_replace($pattern, $replacement, $html);
        }

        return $html;
    }
}
