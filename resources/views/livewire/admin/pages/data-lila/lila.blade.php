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
                            <th>Usia TP</th>
                            <th>Kategori</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Alamat</th>
                            <th>Sekolah</th>
                            <th>LiLA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td>{{ $val->nik }}</td>
                                    <td>{{ $val->Usia_tp->code_nm }}</td>
                                    <td>{{ $val->Kategori->code_nm }}</td>
                                    <td>{{ $val->Kecamatan->region_nm }}</td>
                                    <td>{{ $val->Desa->region_nm }}</td>
                                    <td>{{ $val->alamat }}</td>
                                    <td>{{ $val->Sekolah->nama }}</td>
                                    <td>{{ $val->lila }}</td>
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
            {{ $data->links() }}
        </div>
    </div>
</div>
