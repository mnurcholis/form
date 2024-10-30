<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Rincian Data Bupati dan Gubernur </h6>
                    <div class="header-elements">
                        <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                Live update:

                            </label>
                            <a href="{{ route('dashboard-tps') }}"><i class="mi-refresh mr-3 mi-1x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="col-12 mb-3 row">
                        {{-- <div class="search-set col-md-2">
                            <div class="search-input">
                                <div class="dataTables_filter"><label>
                                        <input type="search" class="form-control form-control-sm" placeholder="Search"
                                            wire:model.live='search'></label></div>
                            </div>
                        </div> --}}
                        <label class="col-form-label col-md-1">Kecamatan</label>
                        <div class="col-md-3">
                            <div class="col-lg-10">
                                <select wire:model.live="searchKecamatan" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($listKec ?? [] as $list)
                                        <option value="{{ $list->region_cd }}">{{ $list->region_nm }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label class="col-form-label col-md-1">Kelurahan / Desa</label>
                        <div class="col-md-3">
                            <div class="col-lg-10">
                                <select wire:model.live="searchDesa" class="form-control">
                                    <option value="">Pilih Kelurahan / Desa</option>
                                    @foreach ($listDesa ?? [] as $list)
                                        <option value="{{ $list['region_cd'] }}">{{ $list['region_nm'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <label class="col-form-label col-md-1">Show</label>
                        <div class="col-md-3">
                            <div class="col-lg-3">
                                <select wire:model.live="limit" class="form-control">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('dashboard-tps') }}" wire:navigate class="btn btn-primary">Reset</a>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="bg-grey-400">
                                <tr>
                                    <th rowspan="2" class="text-center">#</th>
                                    <th rowspan="2" class="text-center">Kecamatan</th>
                                    <th rowspan="2" class="text-center">Desa</th>
                                    {{-- <th rowspan="2" class="text-center">TPS</th> --}}
                                    <th colspan="4" class="text-center">Bupati/Wakil Bupati</th>
                                    <th colspan="4" class="text-center">Gubernur/Wakil Gubernur</th>
                                    <th rowspan="2" class="text-center">DPT</th>
                                    <th rowspan="2" class="text-center">DPTb</th>
                                    <th colspan="4" class="text-center">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-center">1</th>
                                    <th class="text-center">2</th>
                                    <th class="text-center">Suara Tidak Sah</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">1</th>
                                    <th class="text-center">2</th>
                                    <th class="text-center">Suara Tidak Sah</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">DPT + DPTb</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $row)
                                    <tr>
                                        @php
                                            $sum = ($row->total_dpt ?? 0) + ($row->total_dptb ?? 0);
                                        @endphp
                                        <td class="text-left">
                                            {{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                                        <td class="text-left">{{ $row->kecamatanTPS->region_nm ?? '' }}</td>
                                        <td class="text-left">{{ $row->desaTPS->region_nm ?? '' }}</td>
                                        <td class="text-right">{{ number_format($row->total_b_1 ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">{{ number_format($row->total_b_2 ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">{{ number_format($row->total_b_3 ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">

                                            @if ($row->total_b > $sum)
                                                <span style="color:red;">
                                                    {{ number_format($row->total_b ?? 0, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span>
                                                    {{ number_format($row->total_b ?? 0, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right">{{ number_format($row->total_g_1 ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">{{ number_format($row->total_g_2 ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">{{ number_format($row->total_g_3 ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">
                                            @if ($row->total_g > $sum)
                                                <span style="color:red;">
                                                    {{ number_format($row->total_g ?? 0, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span>
                                                    {{ number_format($row->total_g ?? 0, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right"> {{ number_format($row->total_dpt ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">{{ number_format($row->total_dptb ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($row->total_dptb + $row->total_dpt ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-slate">
                                    <td colspan="3">Total</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_b_1') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_b_2') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_b_3') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($data->sum('total_b') ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_g_1') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_g_2') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_g_3') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($data->sum('total_g') ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_dpt') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_dptb') ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($data->sum('total_dpt') + $data->sum('total_dptb') ?? 0, 0, ',', '.') }}

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="text-right flex justify-end">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
