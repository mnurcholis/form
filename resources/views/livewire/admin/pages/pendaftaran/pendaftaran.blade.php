<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Daftar Hadir Garage Show" subjudul="Diskominfo" :breadcrumb="['Daftar Hadir']" />
    </x-slot>

    <div class="card">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="form-group row">
                <form action="#" wire:submit.prevent="simpan">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" wire:model="no_tiket" id="no_tiket"
                            placeholder="Scan Disini">
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sekolah / Organisasi</th>
                            <th>nama</th>
                            <th>no_handphone</th>
                            <th>email</th>
                            <th>Jam Hadir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->so_nama }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td>{{ $val->no_handphone }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>{{ $val->updated_at }}</td>
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
        // Function to set focus on the input element
        function focusInput() {
            document.getElementById('no_tiket').focus();
        }

        // Set an interval to focus the input every 5 seconds
        setInterval(focusInput, 1000);
    </script>
@endpush
