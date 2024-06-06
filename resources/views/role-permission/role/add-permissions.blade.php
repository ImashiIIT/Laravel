<x-first-app>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Roles: {{ $role->name }}
                            <a href="{{ url('roles/create') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="permissions">Permission</label>
                                <div class="row">
                                    @foreach ($permission as $permissions)
                                    <div class="col-md-2">
                                        <label>
                                            <input 
                                                type="checkbox" 
                                                name="permission[]" 
                                                value="{{ $permissions->id }}"
                                                {{ in_array($permissions->id, $rolePermissions) ? 'checked' : '' }} 
                                            />
                                            {{ $permissions->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-first-app>

