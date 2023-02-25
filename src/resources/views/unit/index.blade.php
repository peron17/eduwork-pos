<x-app-layout>
    <x-header :title="__('navigation.unit')">
        <x-header-button :href="route('unit.index')" :title="__('button.create unit')" icon="fa-plus" :modal="false" />
    </x-header>

    <x-column>
        <x-card>
            <x-datatable id="datatable">
                <th>No.</th>
                <th>Nama</th>
                <th>Aksi</th>
            </x-datatable>
        </x-card>
    </x-column>

    @push('script')
    <script>
    $(document).ready(function () {
        
        var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('unit.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    
    });
    
    </script>
    @endpush
</x-app-layout>
