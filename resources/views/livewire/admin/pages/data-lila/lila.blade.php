<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Data Lila" subjudul="Lila" :breadcrumb="['lila']" />
    </x-slot>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Data Pengukuran Lingkar Lengan Atas (LILA)</h5>
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
                        <select wire:model="desa" class="form-control" wire:change='updateFormDesa'>
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
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->nama }}</td>
                                <td>{{ $val->nik }}</td>
                                <td>{{ $val->Kecamatan->region_nm }}</td>
                                <td>{{ $val->Desa->region_nm }}</td>
                                <td>{{ $val->alamat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
