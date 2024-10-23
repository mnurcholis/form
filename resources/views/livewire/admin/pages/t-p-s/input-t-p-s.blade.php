<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="TPS" subjudul="TPS" :breadcrumb="['Data TPS']" />
    </x-slot>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" placeholder="Search">
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
                            <th colspan="4" class="text-center">Gubernur/Wakil Gubernur</th>
                            <th colspan="4" class="text-center">Bupati/Wakil Bupati</th>
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
                            <tr role="row" class="odd {{ $idNya == $row->id ? 'table-active ' : 'disabled' }}">
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                                <td>{{ $row->kecamatanTPS->region_nm }}</td>
                                <td>{{ $row->desaTPS->region_nm }}</td>
                                <td>{{ $row->tps }}</td>
                                <!-- Gubernur Fields -->
                                <td> <input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="g_1.{{ $index }}">
                                </td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="g_2.{{ $index }}">
                                </td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="g_3.{{ $index }}">
                                </td>
                                <td class="text-right">{{ ($row->g_1 ?? 0) + ($row->g_2 ?? 0) + ($row->g_3 ?? 0) }}
                                </td>

                                <!-- Bupati Fields -->
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="b_1.{{ $index }}">
                                </td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="b_2.{{ $index }}">
                                </td>
                                <td><input type="number" class="form-control"
                                        {{ $idNya == $row->id ? '' : 'disabled' }}
                                        wire:model.defer="b_3.{{ $index }}">
                                </td>
                                <td class="text-right">{{ ($row->b_1 ?? 0) + ($row->b_2 ?? 0) + ($row->b_3 ?? 0) }}
                                </td>

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
                            <td>{{ array_sum($g_3) }}</td>
                            <td>{{ array_sum($g_1) + array_sum($g_2) + array_sum($g_3) }}</td>
                            <td>{{ array_sum($b_1) }}</td>
                            <td>{{ array_sum($b_2) }}</td>
                            <td>{{ array_sum($b_3) }}</td>
                            <td>{{ array_sum($b_1) + array_sum($b_2) + array_sum($b_3) }}</td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>
</div>
