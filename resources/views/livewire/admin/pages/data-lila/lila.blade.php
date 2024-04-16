<div>
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Data Lila" subjudul="Lila" :breadcrumb="['lila']" />
    </x-slot>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Data Pengukuran Lingkar Lengan Atas (LILA)</h5>
        </div>

        <div class="card-body">
            <livewire:admin.pages.data-lila.table-lila />
        </div>
    </div>
</div>
