<x-first-app>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card m-3">
                    <div class="card-header">
                        <h4>Edit Roles
                            <a href="{{ url('roles/create') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('roles/'.$role->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="mb-3">
                                <lable for="">Role Name</lable>
                                <input type="text" name="name"value="{{$role->names}}" class="form-control"/>
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