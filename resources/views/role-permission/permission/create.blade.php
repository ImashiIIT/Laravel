<x-first-app>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card m-3">
                    <div class="card-header">
                        <h4>Create Permissions
                            <a href="{{ url('permission/create') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('permission')}}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <lable for="">Permission Name</lable>
                                <input type="text" name="name" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-first-app>