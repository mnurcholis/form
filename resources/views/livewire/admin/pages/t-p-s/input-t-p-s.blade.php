<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="TPS" subjudul="TPS" :breadcrumb="['Data TPS']" />
    </x-slot>
    <div class="card">
        <div class="card-body">
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
                    <a href="{{ route('tps') }}" wire:navigate class="btn btn-primary">Reset</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-grey-400">
                        <tr>
                            <th rowspan="2" class="text-center">#</th>
                            <th rowspan="2" class="text-center">Kecamatan</th>
                            <th rowspan="2" class="text-center">Desa</th>
                            <th rowspan="2" class="text-center">TPS</th>
                            <th colspan="4" class="text-center">Bupati/Wakil Bupati</th>
                            <th colspan="4" class="text-center">Gubernur/Wakil Gubernur</th>
                            <th rowspan="2" class="text-center">DPT</th>
                            <th rowspan="2" class="text-center">DPTb</th>
                            <th rowspan="2" class="text-center">Action</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $row)
                            @php
                                $totalBupati = ($row->b_1 ?? 0) + ($row->b_2 ?? 0) + ($row->b_ts ?? 0);
                                $totalGubernur = ($row->g_1 ?? 0) + ($row->g_2 ?? 0) + ($row->g_ts ?? 0);
                                $total = ($row->dpt ?? 0) + ($row->dptb ?? 0);
                            @endphp
                            <tr role="row" class="odd {{ $idNya == $row->id ? 'table-active ' : 'disabled' }}">
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                                <td>{{ $row->kecamatanTPS->region_nm }}</td>
                                <td>{{ $row->desaTPS->region_nm }}</td>
                                <td>{{ $row->tps }}</td>
                                <!-- Gubernur Fields -->

                                <!-- Bupati Fields -->
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="b_1.{{ $index }}"
                                        onkeypress="return isNumberKey(event)"></td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="b_2.{{ $index }}"
                                        onkeypress="return isNumberKey(event)"></td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="b_ts.{{ $index }}"
                                        onkeypress="return isNumberKey(event)"></td>
                                <td class="text-right">
                                    @if ($totalBupati > $total)
                                        <span style="color:red;">
                                            {{ number_format($totalBupati ?? 0, 0, ',', '.') }}
                                        </span>
                                    @else
                                        {{ number_format($totalBupati ?? 0, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="g_1.{{ $index }}"
                                        onkeypress="return isNumberKey(event)"></td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="g_2.{{ $index }}"
                                        onkeypress="return isNumberKey(event)"></td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="g_ts.{{ $index }}"
                                        onkeypress="return isNumberKey(event)"></td>
                                <td class="text-right">
                                    @if ($totalGubernur > $total)
                                        <span style="color:red;">
                                            {{ number_format($totalGubernur ?? 0, 0, ',', '.') }}
                                        </span>
                                    @else
                                        {{ number_format($totalGubernur ?? 0, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="text-right">{{ number_format($row->dpt ?? 0, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($row->dptb ?? 0, 0, ',', '.') }}</td>
                                <!-- Action Buttons -->
                                <td>
                                    @if ($idNya == $row->id)
                                        <button type="button" class="btn btn-danger"
                                            wire:click="save({{ $index }},{{ $row->id }})">
                                            Simpan <i class="icon-floppy-disk ml-2"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary"
                                            wire:click="edit({{ $row->id }})">
                                            Edit <i class="icon-pencil ml-2"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-slate">
                            <td colspan="4">Total</td>
                            <td>{{ array_sum($g_1) }}</td>
                            <td>{{ array_sum($g_2) }}</td>
                            <td>{{ array_sum($g_ts) }}</td>
                            <td class="text-right">{{ array_sum($g_1) + array_sum($g_2) + array_sum($g_ts) }}</td>
                            <td>{{ array_sum($b_1) }}</td>
                            <td>{{ array_sum($b_2) }}</td>
                            <td>{{ array_sum($b_ts) }}</td>
                            <td class="text-right">{{ array_sum($b_1) + array_sum($b_2) + array_sum($b_ts) }}</td>
                            <td class="text-right">{{ array_sum($dpt) }}</td>
                            <td class="text-right">{{ array_sum($dptb) }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $data->links() }}
    @push('js')
        <script>
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
        </script>
    @endpush
</div>
