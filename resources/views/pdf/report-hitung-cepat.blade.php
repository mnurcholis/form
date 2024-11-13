<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        h2 {
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #6c757d;
            color: #fff;
        }

        .highlight {
            background-color: #f28b82;
            font-weight: bold;
        }

        .footer-total {
            background-color: #90a4ae;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h2>Hasil Perhitungan Cepat</h2>
        <h2>{{ $title }}</h2>

    </div>
    <div class="text-right">
        <span> Waktu Donwload : {{ now()->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i:s') }}</span>
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Kecamatan</th>
                <th rowspan="2">Desa</th>

                <!-- Bupati/Wakil Bupati header group -->
                <th colspan="4">Bupati/Wakil Bupati</th>

                <!-- Gubernur/Wakil Gubernur header group -->
                <th colspan="4">Gubernur/Wakil Gubernur</th>

                <!-- DPT and DPTb header group -->
                <th rowspan="2">DPT</th>
                <th rowspan="2">DPTb</th>

                <!-- Total DPT + DPTb -->
                <th rowspan="2">Total DPT + DPTb</th>
            </tr>
            <tr>
                <!-- Sub-columns for Bupati/Wakil Bupati -->
                <th>No. 1<br> Afif & Amir</th>
                <th>No. 2<br> Khairullah & Sidqi</th>
                <th>Suara <br>Tidak Sah</th>
                <th>Total</th>

                <!-- Sub-columns for Gubernur/Wakil Gubernur -->
                <th>No. 1<br> Andika & Hendi</th>
                <th>No. 2<br> Luthfi & Taj Yasin</th>
                <th>Suara <br>Tidak Sah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    @php
                        $sum = ($row->total_dpt ?? 0) + ($row->total_dptb ?? 0);
                    @endphp
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->kecamatanTPS->region_nm ?? null }}</td>
                    <td>{{ $row->desaTPS->region_nm ?? null }}</td>
                    <td>{{ $row->total_b_1 ?? 0 }}</td>
                    <td>{{ $row->total_b_2 ?? 0 }}</td>
                    <td>{{ $row->total_b_ts ?? 0 }}</td>
                    <td class=" {{ $row->total_b > $sum ? 'highlight' : '' }}">{{ $row->total_b ?? 0 }}</td>
                    <td>{{ $row->total_g_1 ?? 0 }}</td>
                    <td>{{ $row->total_g_2 ?? 0 }}</td>
                    <td>{{ $row->total_g_ts ?? 0 }}</td>
                    <td class="{{ $row->total_g > $sum ? 'highlight' : '' }}">{{ $row->total_g ?? 0 }}</td>
                    <td>{{ $row->total_dpt }}</td>
                    <td>{{ $row->total_dptb }}</td>
                    <td>{{ $row->total_dpt + $row->total_dptb }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="footer-total">
                <td colspan="3">Total</td>
                <td>{{ $data->sum('total_b_1') }}</td>
                <td>{{ $data->sum('total_b_2') }}</td>
                <td>{{ $data->sum('total_b_ts') }}</td>
                <td>{{ $data->sum('total_b') }}</td>
                <td>{{ $data->sum('total_g_1') }}</td>
                <td>{{ $data->sum('total_g_2') }}</td>
                <td>{{ $data->sum('total_g_ts') }}</td>
                <td>{{ $data->sum('total_g') }}</td>
                <td>{{ $data->sum('total_dpt') }}</td>
                <td>{{ $data->sum('total_dptb') }}</td>
                <td>{{ $data->sum('total_dpt') + $data->sum('total_dptb') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
