<x-page-index>

    <x-slot name="page_button">
        @if(!empty($pendaftar))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="rset">
            <!-- <?php print_r($unit) ?> -->

            <select wire:model="pilih_periode" wire:click="rset_prd" class="form-input">
                <option value="">--Pilih Tahun Pelajaran--</option>
                @foreach($tapel as $tapela)
                <option value="{{$tapela->id}}">{{$tapela->tahun}}</option>
                @endforeach
            </select>
            <select wire:model="pilih_unit" wire:click="rset_unit" class="form-input">
                <option value="">--Pilih Unit--</option>
                @foreach($unit as $unite)
                <option value="{{$unite->id}}">{{$unite->nama_unit}}</option>
                @endforeach
            </select>
            <select wire:model="pilih_jenjang" wire:click="rset_jjg" class="form-input">
                <option value="">--Pilih Jenjang--</option>
                @foreach($jenjang as $jenjange)
                <option value="{{$jenjange->id}}">{{$jenjange->nama_jenjang}}</option>
                @endforeach
            </select>
            <select wire:model="pilih_kelas" class="form-input">
                <option value="">--Pilih Kelas--</option>
                @foreach($kelas as $kelase)
                <option value="{{$kelase->id}}">{{$kelase->nama_kelas}}</option>
                @endforeach
            </select>

            <!-- {{$caricalon}} -->
            <!-- {{$pilih_periode}} -->
            <!-- {{$pilih_unit}}
            {{$pilih_jenjang}}
            {{$pilih_kelas}} -->

            <input class="form-input" wire:model.debounce.150ms="caricalon" type="text" placeholder="Tambah warga dari dpt" wire:keydown.escape="rset" wire:keydown.tab="rset" />
            <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">

                @foreach($pendaftar as $i => $pendaftar)
                <div wire:click="tambah(
                    {{$pendaftar->id}},
                    {{$pilih_periode}},
                    {{$pilih_unit}},
                    {{$pilih_jenjang}},
                    {{$pilih_kelas}})" class="list-group-item list-group-item-action">{{ $pendaftar->nama }}</div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- <button class="btn btn-success" @click="showModal = true; $dispatch('form-add')">
            <i class="fas fa-plus-circle"></i> Tambah
        </button> 
        <button class="btn btn-primary" wire:click="$emitTo('admin.warga-form', 'editData', '{{ json_encode($selectedData) }}' )">
            <i class="fas fa-edit"></i> Edit Status Seleksi
        </button>-->
        <!-- <button class="btn btn-success" wire:click="downloadExcel">
            <i class="fas fa-file-excel"></i> Export Excel
        </button> -->
    </x-slot>

    <x-slot name="table_tool">
        <x-table-tool>
            </x-tbtool>
    </x-slot>

    <x-slot name="table_checkbox">
        <input type="checkbox" class="form-check-input" wire:model="selectAll">
    </x-slot>

    <x-slot name="table_column">
        <th>
            <x-table-header field="no_warga" sortField="{{$sortField}}" :sortAsc="$sortAsc">NIS</x-tbheader>
        </th>
        <th>
            <x-table-header field="nama" sortField="{{$sortField}}" :sortAsc="$sortAsc">Nama</x-tbheader>
        </th>
        <th>
            <x-table-header field="jurusan" sortField="{{$sortField}}" :sortAsc="$sortAsc">Alamat</x-tbheader>
        </th>
    </x-slot>

    @forelse ($warga as $data)
    <tr>
        <td><input type="checkbox" class="form-check-input" wire:model="selectedData" value="{{$data->id}}"></td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->pendaftar->nis}}</td>
        <td> {{ $data->pendaftar->nama}}</td>
        <td>{{ $data->pendaftar->alamat}}</td>
        <td align="center">
            <x-table-action_d form="admin.warga-form" iddata="{{$data->id}}">
                </x-tbction>
        </td>

    </tr>
    @empty
    <tr>
        <td colspan="11">Tidak ada data untuk ditampilkan</td>
    </tr>
    @endforelse

    <x-slot name="table_page">
        {{ $warga->links('pagination::bootstrap-4') }}
    </x-slot>

    <x-slot name="page_form">
        <livewire:admin.warga-form>
    </x-slot>

    <x-slot name="dialog">
        @if($id_delete)
        <x-dialog></x-dialog>
        @endif

        <div x-data="{ 'showDetail' : false}" x-on:detail-ready.window="showDetail = true">
            <div x-show.transition="showDetail" x-cloak>
                <livewire:admin.warga-detail>
            </div>
        </div>
    </x-slot>
</x-page-index>