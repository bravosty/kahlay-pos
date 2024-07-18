<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kahlay Point of Sale</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
  <div class="bg-dark py-3">
    <h3 class="text-white text-center">Edit Product</h3>
  </div>

  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
        <div class="card border-0 shadow-lg my-4">
          <div class="card-header bg-dark py-3 d-flex justify-content-between align-items-center">
            <h2 class="text-white" style="padding-left: 20px;">Update Product</h2>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
          </div>
          <div>
            <form enctype="multipart/form-data" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="mb-3">
                  <label for="product" class="form-label h4">Product</label>
                  <input value="{{old('product', $product->product)}}" type="text" class="@error('product') is-invalid @enderror form-control form-control-lg" placeholder="product" name="product">
                  @error('product')
                  <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="category" class="form-label h4">Category</label>
                  <input value="{{old('category', $product->category)}}" type="text" class="@error('category') is-invalid @enderror form-control form-control-lg" placeholder="category" name="category">
                  @error('category')
                  <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="price" class="form-label h4">Price</label>
                  <input value="{{old('price', $product->price)}}" type="text" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="price" name="price">
                  @error('price')
                  <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label h4">Description</label>
                  <textarea placeholder="Product description" name="description" class="form-control" cols="30" rows="5">{{old('description', $product->description)}}</textarea>
                </div>
                <div class="mb-3" style="margin-top: 20px;">
                  <label for="image" class="form-label h4">Image</label>
                  <input type="file" name="image" class="form-control">
                  @if ($product->image !="")
                    <img width="30%" height="50%" style="margin-top: 20px;" src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="product-image">
                  @endif
                </div>
                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-lg btn-dark">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
