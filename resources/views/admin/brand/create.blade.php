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

                    <h2>Add Brand

                        <a href="{{ route('brand.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3">
                                <label for="">Brand name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="">Brand status</label><br>
                                <input type="checkbox" name="status" style="width: 30px; height: 30px"/>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Save</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
