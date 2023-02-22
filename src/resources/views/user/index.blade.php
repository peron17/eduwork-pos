<x-app-layout>
    <x-header :title="__('navigation.user')">
        <x-header-button :href="route('user.create')" :title="__('button.create user')" icon="fa-plus" :modal="false" />
    </x-header>

    <x-column>
        <x-card>
            <x-datatable id="datatable">
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
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
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'is_active', name: 'is_active', searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    
    });
    
    </script>
    @endpush
</x-app-layout>
