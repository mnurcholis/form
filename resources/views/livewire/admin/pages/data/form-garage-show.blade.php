<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Data Lila" subjudul="Lila" :breadcrumb="['lila']" />
    </x-slot>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Data Daftar Hadir Garage Show</h5>
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
                        <label>PIlih Jenis Perwakilan *</label>
                        {{ Form::select(null, get_code_group('JENIS_SO'), null, [
                            'class' => 'form-control' . ($errors->has('type') ? ' border-danger' : null),
                            'placeholder' => 'Pilih Jenis',
                            'wire:model.lazy' => 'type',
                            'wire:change' => 'UpdateType',
                        ]) }}
                        @error('type')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Sekolah / Organisasi *</label> <br>
                        <select wire:model="sekolahorg_id" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($listType ?? [] as $list)
                                <option value="{{ $list['id'] }}">{{ $list['nama'] }}
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
                            <th>so_nama</th>
                            <th>code_nm</th>
                            <th>nama</th>
                            <th>no_handphone</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->so_nama }}</td>
                                    <td>{{ $val->code_nm }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td>{{ $val->no_handphone }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm"
                                            wire:click='confirmDelete({{ $val->id }})'><i
                                                class="icon-trash"></i></button>
                                    </td>
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
        document.addEventListener('confirmDelete', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.Delete()
                }
            });
        });
        document.addEventListener('Delete', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Data Berhasil dihapus",
                showConfirmButton: false,
                timer: 1000
            });
        });
    </script>
@endpush
