@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h2 class="alert alert-success">{{ session('message') }}</h2>
            @endif
            <div class="card">

                <div class="card-header">

                    <h2>Edit product

                        <a href="{{ route('product.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">SEO
                                    Tags</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="detaits-tab" data-bs-toggle="tab"
                                    data-bs-target="#detaits-tab-pane" type="button" role="tab"
                                    aria-controls="detaits-tab-pane" aria-selected="false">Details</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">Product images</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab"
                                    data-bs-target="#colors-tab-pane" type="button" role="tab"
                                    aria-controls="colors-tab-pane" aria-selected="false">Product colors</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" id="">

                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @empty
                                            <option value="">None</option>
                                        @endforelse

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Product name</label>
                                    <input type="text" value='{{ $product->name }}' name="name"
                                        class="form-control" />

                                </div>

                                <div class="mb-3">
                                    <label>Product slug</label>
                                    <input type="text" value='{{ $product->slug }}' name="slug"
                                        class="form-control" />

                                </div>

                                <div class="mb-3">
                                    <label>Select brand</label>
                                    <select name="brand" class="form-control" id="">

                                        @forelse ($brands as $brand)
                                            <option value="{{ $brand->name }}"
                                                {{ $brand->name == $product->brand ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @empty
                                            <option value="">None</option>
                                        @endforelse

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" value="" class="form-control" rows="4">{{ $product->description }}</textarea>

                                </div>

                                <div class="mb-3">
                                    <label>Small description</label>
                                    <textarea name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>

                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab" tabindex="0">

                                <div class="mb-3">
                                    <label>Meta title</label>
                                    <input type="text" name="meta_title" value="{{ $product->meta_title }}"
                                        class="form-control" />

                                </div>

                                <div class="mb-3">
                                    <label>Meta description</label>
                                    <textarea type="text" name="meta_description" class="form-control" rows="4">
                                        {{ $product->meta_description }}
                                    </textarea>

                                </div>

                                <div class="mb-3">
                                    <label>Meta keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="4">
                                        {{ $product->meta_keyword }}
                                    </textarea>

                                </div>

                            </div>

                            <div class="tab-pane fade border p-3" id="detaits-tab-pane" role="tabpanel"
                                aria-labelledby="detaits-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Original price</label>
                                            <input type="text" name="original_price"
                                                value="{{ $product->original_price }}" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Sale price</label>
                                            <input type="text" name="sale_price" value="{{ $product->sale_price }}"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" value="{{ $product->quantity }}"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Trending</label><br>
                                            <input type="checkbox" name="trending"
                                                {{ $product->trending == '1' ? 'checked' : '' }}
                                                style="width: 20px; height: 20px" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Featured</label><br>
                                            <input type="checkbox" name="featured"
                                                {{ $product->featured == '1' ? 'checked' : '' }}
                                                style="width: 20px; height: 20px" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Status</label><br>
                                            <input type="checkbox" name="status"
                                                {{ $product->status == '1' ? 'checked' : '' }}
                                                style="width: 20px; height: 20px" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="md-3">
                                    <label>Upload product images</label>
                                    <input type="file" name="image[]" multiple class="form-control" />
                                </div><br>
                                <div>
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $image)
                                                <div class="col-md-2">
                                                    {{-- {{ dd($image->image) }} --}}
                                                    <img src="{{ asset('uploads/products') . '/' . $image->image }}"
                                                        style="width: 80px; height: 80px;" class="me-4 border"
                                                        alt="Img" />
                                                    <a href="{{ route('product-img.delete', $image->id) }}"
                                                        onclick="return confirm('Bạn có chắc muốn xoá hình này không?')"
                                                        class="d-block">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>Không tìm thấy hình ảnh nàp</h5>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel"
                                aria-labelledby="colors-tab" tabindex="0">
                                <div class="md-3">
                                    <h4>Edit product colors</h4>
                                    <label>Select colors</label>
                                    <div class="row">
                                        @forelse ($colors as $color_item)
                                            <div class="col-md-3">
                                                <div class="p-2 border">
                                                    Color: <input type="checkbox" name="colors[{{ $color_item->id }}]"
                                                        value="{{ $color_item->id }}" />{{ $color_item->name }}<br>
                                                    Quantity: <input type="number"
                                                        name="color_quantity[{{ $color_item->id }}]"
                                                        style="width: 70px; border: 1px solid" />
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>Không tìm thấy</h1>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Color name</th>
                                                <th>Quantity</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->productColor as $prodColor)
                                                <tr class="prod-color-tr">
                                                    @if ($prodColor->color)
                                                        <td>{{ $prodColor->color->name }}</td>
                                                    @else
                                                        Không tìm thấy màu nào
                                                    @endif

                                                    <td>
                                                        <div class="input-group mb-3" style="width: 150px">
                                                            <input type="text" value="{{ $prodColor->quantity }}"
                                                                class=" productColorQuantity form-control form-control-sm" />
                                                            <button type="button" value="{{ $prodColor->id }}"
                                                                class=" updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" value="{{ $prodColor->id }}"
                                                            class=" deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>


                            </div>

                        </div>


                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end text-white">Lưu</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.updateProductColorBtn', function() {

                var product_id = '{{ $product->id }}';
                var prod_color_id = $(this).val();
                var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
                // alert(prod_color_id);

                if (qty <= 0) {

                    alert('Hãy điền số lượng');
                    return false;

                }

                var data = {
                    'product_id': product_id,
                    'qty': qty
                };

                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/" + prod_color_id,
                    data: data,
                    success: function(response) {
                        alert(response.message)
                    }
                });
            });


            $(document).on('click', '.deleteProductColorBtn', function() {

                var prod_color_id = $(this).val();
                var thisClick = $(this);

                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/" + prod_color_id + "/delete",
                    success: function(response) {
                        thisClick.closest('.prod-color-tr').remove();
                        alert(response.message);
                    }
                });

            });

        });
    </script>
@endsection
