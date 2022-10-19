@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Add User

                        <a href="{{ route('user.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="">Name</label>
                                <input type="text"  name="name" class="form-control"/>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="">Email</label>
                                <textarea id="" type="email" name="email" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control"/>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="">Password</label><br>
                                <input type="password" name="password" class="form-control"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="">Select role</label><br>
                                <select name="role" class="form-control" id="">
                                    <option value="">Select role</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Lưu</button>
                            </div>
                        </div>



                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection

