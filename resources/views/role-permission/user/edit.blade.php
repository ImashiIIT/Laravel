<x-first-app>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card m-3">
                    <div class="card-header">
                        <h4>Edit User
                            <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT method for update -->
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"/>
                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}"/> 
                               

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"/>
                                @error('password') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            </div>

                            <div class="mb-3">
                                <label for="roles">Role</label>
                                <select name="roles[]" id="roles" class="form-control" multiple>
                                    <option class="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option 
                                        value="{{ $role }}" 
                                        {{in_array($role,$userRoles)?'selected':''}}
                                        >
                                        {{ $role }}
                                    </option> <!-- Pre-select user's current roles -->
                                    @endforeach
                                </select>
                                @error('roles') <span class="text-danger">{{$message}}</span> @enderror
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
