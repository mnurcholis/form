<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Data TPS" subjudul="TPS" :breadcrumb="['Data TPS']" />
    </x-slot>
    <div class="card">
        @if (session()->has('success'))
            <div class="alert alert-success alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                {{ session('success') }}
            </div>
        @endif
        @if ($form)
            <div class="card-body">
                <form action="#" wire:submit.prevent="simpan">
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Data Sekolah</legend>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Kecamatan *</label>
                            <div class="col-lg-10">
                                <select wire:model="kecamatan" class="form-control" wire:change='updateFormKecamatan'>
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($region_kec ?? [] as $list)
                                        <option value="{{ $list->region_cd }}">{{ $list->region_nm }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kecamatan')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Kelurahan / Desa</label>
                            <div class="col-lg-10">
                                <select wire:model="desa" class="form-control">
                                    <option value="">Pilih Kelurahan / Desa</option>
                                    @foreach ($region_kel ?? [] as $list)
                                        <option value="{{ $list['region_cd'] }}">{{ $list['region_nm'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('desa')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">TPS *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" wire:model="tps" placeholder="001">
                            </div>
                            @error('desa')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <button type="button" class="btn btn-warning" wire:click="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan<i
                                class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        @else
            <div class="card-body">
                <div class="text-right">
                    <a href="#" class="btn btn-info" wire:click.prevent="toModalImport">{{ __('Import TPS') }}</a>
                    {{-- <button type="button" class="btn btn-primary" wire:click="tambah">Tambah TPS<i
                            class="icon-paperplane ml-2"></i></button> --}}
                </div>
            </div>
        @endif
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    {{ session('success') }}
                </div>
            @endif
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
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" wire:click="clear" wire:loading.remove>Reset</button>
                    <div wire:loading wire:target="clear">
                        <button class="btn btn-secondary-light" type="button" disabled>
                            <span class="spinner-grow spinner-grow-sm align-middle" role="status"
                                aria-hidden="true"></span>
                            Clearing...
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>TPS</th>
                            <th>DPT</th>
                            <th>DPTb</th>
                            {{-- <th class="text-center">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $index => $val)
                                <tr role="row" class="odd {{ $idNya == $val->id ? 'table-active' : '' }}">
                                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                                    <td>{{ $val->kecamatanTPS->region_nm }}</td>
                                    <td>{{ $val->desaTPS->region_nm ?? $val->desa }}</td>
                                    <td>{{ $val->tps }}</td>
                                    <td>{{ $val->dpt ?? 0 }}</td>
                                    <td>{{ $val->dptb ?? 0 }}</td>
                                    {{-- <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(22px, 19px, 0px);">
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-pencil"></i>Edit</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-trash"></i>Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">Data Tidak Ada</td>
                            </tr>
                        @endif
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th colspan="2">Jumlah Data : {{ $coba->count() }}</th>
                            <th colspan="7"></th>
                        </tr>
                    </tfoot> --}}
                </table>
                <br>
            </div>
            {{ $data->links() }}
        </div>
    </div>
    <div class="modal modal-xl fade" id="modal-form" data-backdrop="static" data-keyboard="false" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import TPS</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-2 row">
                        <div wire:loading wire:target="importUser">
                            <div wire:stream.replace="progress">
                                <progress max="100" value="{{ $progress }}"></progress>
                                <p>{{ $progress }}%</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        @if ($errors->any())
                            <div>
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}

                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <label class="col-form-label col-md-2">{{ __('File') }}</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control @error('file') is-invalid  @enderror"
                                wire:model="file" accept=".xlsx,.csv,.xls">
                            <div wire:loading wire:target="file">
                                Uploading...</div>
                            @if (isset($file))
                                <i class="icon-checkmark2"></i>
                            @else
                            @endif
                            @error('file')
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="importTps" class="btn btn-primary" wire:loading.remove>Save
                        changes</button>
                    <div wire:loading wire:target="importTps">
                        <button class="btn btn-secondary-light" type="button" disabled>
                            <span class="spinner-grow spinner-grow-sm align-middle" role="status"
                                aria-hidden="true"></span>
                            Import...
                        </button>
                    </div>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                </div>

            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                window.addEventListener('import-tps', event => {
                    $('#modal-form').modal('show');
                });
            });
            $(document).ready(function() {
                window.addEventListener('close-import-tps', event => {
                    $('#modal-form').modal('hide');
                });
            });
            $('.select-select').select2({});
            $('.select-select').on('change', function(e) {
                var data = $('.select-select').select2("val");
                @this.set('sekolah_id', data);
            });
        </script>
    @endpush
</div>
