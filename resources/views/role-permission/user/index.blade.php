<x-first-app>
<div class="container m-6">
    @include('role-permission.nav-links')
   
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card m-3">
                    <div class="card-header">
                        <h4>Users
                            <a href="{{ route('users.create') }}" class="btn btn-primary float-end">Add Users</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-first-app>
