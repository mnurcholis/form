<?php

namespace App\Http\Controllers;

use App\Models\ComRegion;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartDataController extends Controller
{
    public function getChartData()
    {
        // Aggregate data for Bupati
        $bupatiData = Hasil::select(
            'kecamatan',
            DB::raw('SUM(b_1) as total_b1'),
            DB::raw('SUM(b_2) as total_b2'),
            DB::raw('SUM(b_ts) as total_bts'),
            DB::raw('SUM(dpt + dptb + dpk) as total_pemilih')
        )->groupBy('kecamatan')->get();

        $bupatiRegions = [];
        $bupatiB1 = [];
        $bupatiB2 = [];
        $bupatiBTS = [];
        $bupatiPercentages = [];

        foreach ($bupatiData as $row) {
            $region = ComRegion::where('region_cd', $row->kecamatan)->first();
            $bupatiRegions[] = $region->region_nm;
            $bupatiB1[] = $row->total_b1;
            $bupatiB2[] = $row->total_b2;
            $bupatiBTS[] = $row->total_bts;
            $totalPemilih = $row->total_pemilih ?: 1; // Hindari pembagian dengan nol
            $bupatiPercentages[] = [
                'b1' => round(($row->total_b1 / $totalPemilih) * 100, 2),
                'b2' => round(($row->total_b2 / $totalPemilih) * 100, 2),
                'bts' => round(($row->total_bts / $totalPemilih) * 100, 2),
            ];
        }

        // Aggregate data for Gubernur
        $gubernurData = Hasil::select(
            'kecamatan',
            DB::raw('SUM(g_1) as total_g1'),
            DB::raw('SUM(g_2) as total_g2'),
            DB::raw('SUM(g_ts) as total_gts'),
            DB::raw('SUM(dpt + dptb + dpk) as total_pemilih')
        )->groupBy('kecamatan')->get();

        $gubernurRegions = [];
        $gubernurG1 = [];
        $gubernurG2 = [];
        $gubernurGTS = [];
        $gubernurPercentages = [];
        foreach ($gubernurData as $row) {
            $region = ComRegion::where('region_cd', $row->kecamatan)->first();
            $gubernurRegions[] = $region->region_nm;
            $gubernurG1[] = $row->total_g1;
            $gubernurG2[] = $row->total_g2;
            $gubernurGTS[] = $row->total_gts;
            $totalPemilih = $row->total_pemilih ?: 1; // Hindari pembagian dengan nol
            $gubernurPercentages[] = [
                'g1' => round(($row->total_g1 / $totalPemilih) * 100, 2),
                'g2' => round(($row->total_g2 / $totalPemilih) * 100, 2),
                'gts' => round(($row->total_gts / $totalPemilih) * 100, 2),
            ];
        }

        // Pie chart totals
        $bupatiTotal = [
            array_sum($bupatiB1),
            array_sum($bupatiB2),
            array_sum($bupatiBTS),
        ];

        $gubernurTotal = [
            array_sum($gubernurG1),
            array_sum($gubernurG2),
            array_sum($gubernurGTS),
        ];

        // Prepare API response
        return response()->json([
            'bupati' => $bupatiTotal,
            'bupatiPercentages' => $bupatiPercentages,
            'gubernur' => $gubernurTotal,
            'gubernurPercentages' => $gubernurPercentages,
            'bupatiRegions' => $bupatiRegions,
            'bupatiB1' => $bupatiB1,
            'bupatiB2' => $bupatiB2,
            'bupatiBTS' => $bupatiBTS,
            'gubernurRegions' => $gubernurRegions,
            'gubernurG1' => $gubernurG1,
            'gubernurG2' => $gubernurG2,
            'gubernurGTS' => $gubernurGTS,
        ]);
    }
}
