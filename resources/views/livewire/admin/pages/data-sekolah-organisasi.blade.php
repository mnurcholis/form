<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Data Sekolah" subjudul="Sekolah" :breadcrumb="['Sekolah']" />
    </x-slot>

    <div class="card">
        <div class="card-header header-elements-inline">
            @if (!$isOpen)
                <button type="button" class="btn btn-warning" wire:click="create">Tambah</button>
            @endif
        </div>

        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    {{ session('success') }}
                </div>
            @endif
            @if ($isOpen)
                <form action="#" wire:submit.prevent="simpan">
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Data Sekolah</legend>
                        {{-- <div class="form-group row">
                            <label class="col-form-label col-lg-2">NSM</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" wire:model="sekolah.nsm">
                            </div>
                            @error('sekolah.nsm')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">NPSM</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" wire:model="sekolah.npsm">
                            </div>
                            @error('sekolah.nama')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label"> Perwakilan SMA/SMK/Sederajat / Komunitas/Organisasi
                                Pemuda</label>
                            <div class="col-lg-2">
                                {{ Form::select(null, get_code_group('JENIS_SO'), null, [
                                    'class' => 'form-control' . ($errors->has('sekolah.type') ? ' border-danger' : null),
                                    'placeholder' => 'Pilih Jenis',
                                    'wire:model.lazy' => 'sekolah.type',
                                ]) }}
                                @error('sekolah.type')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Nama *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" wire:model="sekolah.nama">
                            </div>
                            @error('sekolah.nama')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Alamat</label>
                            <div class="col-lg-10">
                                <textarea cols="" rows="3" wire:model="sekolah.alamat" class="form-control"></textarea>
                            </div>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <button type="button" class="btn btn-warning" wire:click="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit <i
                                class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            @else
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Cari Nama</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" wire:model="nama">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->count() > 0)
                                @foreach ($data as $val)
                                    <tr>
                                        <td>{{ $val->id }}</td>
                                        {{-- <td>{{ $val->nsm }}</td>
                                        <td>{{ $val->npsm }}</td> --}}
                                        <td>{{ $val->Type->code_nm }}</td>
                                        <td>{{ $val->nama }}</td>
                                        <td>{{ $val->alamat }}</td>
                                        <td><button type="button" wire:click='Edit({{ $val->id }})'
                                                class="btn btn-sm btn-primary">Edit</button></td>
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
            @endif
        </div>
    </div>
</div>
