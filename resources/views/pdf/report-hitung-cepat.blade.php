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
            font-size: 10px;
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
                <th rowspan="2">DPK</th>
                <!-- Total DPT + DPTb -->
                <th rowspan="2">Total DPT + DPTb + DPK</th>
            </tr>
            <tr>
                <!-- Sub-columns for Bupati/Wakil Bupati -->
                <th>No. 1<br> Afif & Amir</th>
                <th>No. 2<br> Khairullah & Sidqi</th>
                <th>Suara Tidak Sah</th>
                <th>Total</th>

                <!-- Sub-columns for Gubernur/Wakil Gubernur -->
                <th>No. 1<br> Andika & Hendi</th>
                <th>No. 2<br> Luthfi & Taj Yasin</th>
                <th>Suara Tidak Sah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->kecamatanTPS->region_nm ?? null }}</td>
                    <td>{{ $row->desaTPS->region_nm ?? null }}</td>
                    <td class="text-right"> {{ number_format($row->total_b_1 ?? 0, 0, ',', '.') }}
                        <br> ({{ number_format($row->perc_b_1 ?? 0, 2) }})
                    </td>
                    <td class="text-right"> {{ number_format($row->total_b_2 ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_b_2 ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right">{{ number_format($row->total_b_ts ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_b_ts ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right {{ $row->total_b > $row->total_sum ? 'highlight' : '' }}">
                        {{ number_format($row->total_b ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_total_b ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right"> {{ number_format($row->total_g_1 ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_g_1 ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right">{{ number_format($row->total_g_2 ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_g_2 ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right"> {{ number_format($row->total_g_ts ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_g_ts ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right {{ $row->total_g > $row->total_sum ? 'highlight' : '' }}">
                        {{ number_format($row->total_g ?? 0, 0, ',', '.') }}
                        {{-- <br> ({{ number_format($row->perc_total_g ?? 0, 2) }}%) --}}
                    </td>
                    <td class="text-right">{{ number_format($row->total_dpt ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row->total_dptb ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row->total_dpk ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row->total_sum ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="footer-total">
                <td colspan="3">Total</td>
                <td class="text-right">{{ $data->sum('total_b_1') }}</td>
                <td class="text-right">{{ $data->sum('total_b_2') }}</td>
                <td class="text-right">{{ $data->sum('total_b_ts') }}</td>
                <td class="text-right">{{ $data->sum('total_b') }}</td>
                <td class="text-right">{{ $data->sum('total_g_1') }}</td>
                <td class="text-right">{{ $data->sum('total_g_2') }}</td>
                <td class="text-right">{{ $data->sum('total_g_ts') }}</td>
                <td class="text-right">{{ $data->sum('total_g') }}</td>
                <td class="text-right">{{ $data->sum('total_dpt') }}</td>
                <td class="text-right">{{ $data->sum('total_dptb') }}</td>
                <td class="text-right">{{ $data->sum('total_dpk') }}</td>
                <td class="text-right">
                    {{ $data->sum('total_dpt') + $data->sum('total_dptb') + $data->sum('total_dpk') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
