<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Dashboard" subjudul="Dasboard" :breadcrumb="[]" />
    </x-slot>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Rekap perdesa Pengukuran Lingkar Lengan Atas (LILA)</h5>
            <div class="header-elements">
                <button class="btn btn-sm btn-warning" wire:click="exportData" wire:loading.attr="disabled">Export</button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Kecamatan *</label>
                        <select wire:model="kecamatan" class="form-control" wire:change='updateFormKecamatan'>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($region_kec ?? [] as $list)
                                <option value="{{ $list->region_cd }}">{{ $list->region_nm }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Kelurahan / Desa *</label> <br>
                        <select wire:model="desa" class="form-control">
                            <option value="">Pilih Kelurahan / Desa</option>
                            @foreach ($region_kel ?? [] as $list)
                                <option value="{{ $list['region_cd'] }}">{{ $list['region_nm'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('desa')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Desa</th>
                            <th>Jumlah</th>
                            <th>Tidak Kek</th>
                            <th>Kek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $val)
                                <tr>
                                    <td>{{ $val->nama_desa }}</td>
                                    <td>{{ $val->jumlah }}</td>
                                    <td>{{ $val->tidakkek }}</td>
                                    <td>{{ $val->kek }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">Data Tidak Ada</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>
