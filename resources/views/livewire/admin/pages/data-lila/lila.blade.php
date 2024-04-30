<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Data Lila" subjudul="Lila" :breadcrumb="['lila']" />
    </x-slot>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Data Pengukuran Lingkar Lengan Atas (LILA)</h5>
            <div class="header-elements">
                <button class="btn btn-sm btn-warning" wire:click="exportData" wire:loading.attr="disabled">Export</button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label>Nama</label>
                        <input type="text" class="form-control" wire:model="nama">
                        @error('nama')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Nik</label>
                        <input type="text" class="form-control" wire:model="nik">
                        @error('nik')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <label>Usia</label> <br>
                        {{ Form::select(null, get_code_group('USIA_TP'), null, [
                            'class' => 'form-control' . ($errors->has('usia_tp') ? ' border-danger' : null),
                            'placeholder' => 'Pilih Usia',
                            'wire:model' => 'usia_tp',
                            'wire:change' => 'updateFormUsia',
                        ]) }}
                        @error('usia_tp')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Kategori</label> <br>
                        {{ Form::select(null, get_code_group('KATEGORI_TP'), null, [
                            'class' => 'form-control' . ($errors->has('kategori_tp') ? ' border-danger' : null),
                            'placeholder' => 'Pilih Kategori',
                            'wire:model' => 'kategori_tp',
                        ]) }}
                        @error('kategori_tp')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4" wire:ignore>
                        <label>Sekolah</label> <br>
                        <select wire:model="sekolah_id" class="form-control select-select">
                            <option value="">Pilih Sekolah</option>
                            @foreach ($sekolah ?? [] as $list)
                                <option value="{{ $list->id }}">{{ $list->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_tp')
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
                            <th>Alamat</th>
                            <th>Desa</th>
                            <th>Sekolah</th>
                            <th>Kategori</th>
                            <th>Usia TP</th>
                            <th colspan="2" class="text-center">LiLA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td>{{ $val->nik }}</td>
                                    <td>{{ $val->Kecamatan }}</td>
                                    <td>{{ $val->Desa }}</td>
                                    <td>{{ $val->alamat }}</td>
                                    <td>{{ $val->Sekolah ?? '' }}</td>
                                    <td>{{ $val->Kategori ?? '' }}</td>
                                    <td>{{ $val->Usia ?? '' }}</td>
                                    <td>{{ $val->lila }}</td>
                                    <td>{{ $val->ConditionResult }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">Data Tidak Ada</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Jumlah Data : {{ $coba->count() }}</th>
                            <th colspan="7"></th>
                            <th colspan="2">
                                Jumlah Tidak Kek : <b>{{ $coba->where('ConditionResult', 'tidak kek')->count() }}</b><br>
                                Jumlah Kek : <b>{{ $coba->where('ConditionResult', 'kek')->count() }}</b>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <br>
            </div>
            {{ $data->links() }}
        </div>
    </div>
</div>
@push('js')
    <script>
        $('.select-select').select2({});
        $('.select-select').on('change', function(e) {
            var data = $('.select-select').select2("val");
            @this.set('sekolah_id', data);
        });
    </script>
@endpush
