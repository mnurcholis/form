<div>
    <!-- Main content -->
    <div class="content-wrapper">

        <div class="content">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Daftar Hadir GARAGE SHOW DISKOMINFO WONOSOBO -  SESI ICT FORM DUMMIES</h5>
                </div>
                @if ($tampil)
                    <div class="card-body">
                        <form action="#" wire:submit.prevent="simpan">
                            <fieldset class="mb-3">
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
                                            <label>PIlih Jenis Perwakilan *</label>
                                            {{ Form::select(null, get_code_group('JENIS_SO'), null, [
                                                'class' => 'form-control' . ($errors->has('form.type') ? ' border-danger' : null),
                                                'placeholder' => 'Pilih Jenis',
                                                'wire:model.lazy' => 'form.type',
                                                'wire:change' => 'UpdateType',
                                            ]) }}
                                            @error('form.type')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nama Sekolah/Organisai *</label> <br>
                                            <select wire:model="form.sekolahorg_id" class="form-control">
                                                <option value="">Pilih</option>
                                                @foreach ($listType ?? [] as $list)
                                                    <option value="{{ $list['id'] }}">{{ $list['nama'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('form.sekolahorg_id')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
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
                                    <label class="col-form-label col-lg-2">No Handphone *</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" wire:model="form.no_handphone">
                                    </div>
                                    @error('form.no_handphone')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">Email *</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" wire:model="form.email">
                                    </div>
                                    @error('form.email')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


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
