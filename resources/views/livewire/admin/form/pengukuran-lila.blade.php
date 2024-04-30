<div>
    <!-- Main content -->
    <div class="content-wrapper">

        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Pengukuran Lingkar Lengan Atas (LILA)</h5>
                </div>
                @if ($tampil)
                    <div class="card-body">
                        <form action="#" wire:submit.prevent="simpan">
                            <fieldset class="mb-3">
                                <legend class="text-uppercase font-size-sm font-weight-bold">Pengukuran Lingkar Lengan
                                    Atas
                                    (LILA) Kabupaten Wonosobo Tahun 2024</legend>
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-styled-left alert-dismissible">
                                        <button type="button" class="close"
                                            data-dismiss="alert"><span>×</span></button>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kecamatan *</label>
                                            <select wire:model="form.kecamatan" class="form-control"
                                                wire:change='updateFormKecamatan'>
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($region_kec ?? [] as $list)
                                                    <option value="{{ $list->region_cd }}">{{ $list->region_nm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('form.kecamatan')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kelurahan / Desa *</label> <br>
                                            <select wire:model="form.desa" class="form-control">
                                                <option value="">Pilih Kelurahan / Desa</option>
                                                @foreach ($region_kel ?? [] as $list)
                                                    <option value="{{ $list['region_cd'] }}">{{ $list['region_nm'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('form.desa')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Alamat</label>
                                            <textarea cols="" rows="3" wire:model="form.alamat" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12" wire:ignore>
                                            <label>Sekolah</label>
                                            <select wire:model="form.sekolah_id" class="form-control select-select">
                                                <option value="">Pilih Sekolah</option>
                                                @foreach ($sekolah ?? [] as $list)
                                                    <option value="{{ $list->id }}">{{ $list->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">Nama *</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" wire:model="form.nama">
                                    </div>
                                    @error('form.nama')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">NIK</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" wire:model="form.nik">
                                    </div>
                                    @error('form.nik')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Usia</label>
                                    <div class="col-lg-2">
                                        {{ Form::select(null, get_code_group('USIA_TP'), null, [
                                            'class' => 'form-control' . ($errors->has('form.usia_tp') ? ' border-danger' : null),
                                            'placeholder' => 'Pilih Usia',
                                            'wire:model.lazy' => 'form.usia_tp',
                                        ]) }}
                                        @error('form.usia_tp')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Kategori *</label>
                                    <div class="col-lg-2">
                                        {{ Form::select(null, get_code_group('KATEGORI_TP'), null, [
                                            'class' => 'form-control' . ($errors->has('form.kategori_tp') ? ' border-danger' : null),
                                            'placeholder' => 'Pilih Kategori',
                                            'wire:model.lazy' => 'form.kategori_tp',
                                        ]) }}
                                        @error('form.kategori_tp')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">Ukuran Lingkar Lengan Atas *</label>
                                    <div class="col-lg-10">
                                        <input type="number" step="0.1" class="form-control"
                                            wire:model="form.lila">
                                    </div>
                                    @error('form.lila')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="form-group row">
                                <label class="col-form-label col-lg-2">Kek</label>
                                <div class="col-lg-10">
                                    <select class="form-control" wire:model="form.kek">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                @error('form.kek')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            </fieldset>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit <i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('.select-select').select2({});
        $('.select-select').on('change', function(e) {
            var data = $('.select-select').select2("val");
            @this.set('form.sekolah_id', data);
        });
        $(document).ready(function() {
            window.addEventListener('kosong_sekolah', event => {
                $('.select-select').select2('destroy').val('').select2();
            });
        });
    </script>
@endpush
