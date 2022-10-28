@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
            <div class="card">
                <div class="card-header">

                    <h2>Edit color

                        <a href="{{ route('color.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">


                    <form action="{{ route('color.update', $color->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $color->name }}" class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Code</label>
                                <input type="text" name="code" value="{{ $color->code }}" class="form-control"/>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" {{ $color->status == '1' ? 'checked' : '' }} name="status" style="width: 20px; height: 20px"/>
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
