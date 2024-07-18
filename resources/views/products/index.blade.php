<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kahlay Point of Sale</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <style>
    .product-image {
      max-width: 150px; /* Adjusted to make images more visible */
      border-radius: 8px; /* Rounded corners */
      box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Optional: Add shadow for depth */
    }
    .sidebar {
      width: 20%; /* Set a relative width for the sidebar */
      padding: 20px; /* Add some padding to the sidebar */
      box-sizing: border-box; /* Include padding in the width calculation */
    }
    @media (max-width: 768px) {
      .sidebar {
        width: 30%; /* Increase the width for smaller screens */
      }
    }
    @media (max-width: 480px) {
      .sidebar {
        width: 40%; /* Increase the width for even smaller screens */
      }
    }
    .dashboard-card, .product-card {
      width: 100%; /* Make the card full width */
      margin: 20px 0; /* Add some margin to the card */
      padding: 0 20px; /* Add padding to the card */
      box-sizing: border-box; /* Include padding in the width calculation */
    }
    .dashboard-header {
      padding: 20px; /* Add padding to the header */
    }
    .product-card {
      padding: 20px; /* Increase padding for better spacing */
    }
  </style>
</head>
<body>
  <div class="bg-dark py-3 d-flex justify-content-between align-items-center">
    <h3 class="text-white text-center flex-grow-1">Kahlay Dashboard</h3>
    <a href="{{ route('products.index') }}" class="text-white" style="padding-right: 20px;" title="Add Product">
      <i class="fa fa-bell fa-2x"></i>
    </a>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 sidebar">
        <div class="card border-0 shadow-lg my-4">
          <div class="card-body">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-home fa-fw"></i> Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-box fa-fw"></i> Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-warehouse fa-fw"></i> Warehouses</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-truck fa-fw"></i> Suppliers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-money-bill fa-fw"></i> Expenses</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-chart-line fa-fw"></i> Sales</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fas fa-cog fa-fw"></i> Settings</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-12">
            <div class="card border-0 shadow-lg my-4">
              <div class="card-header bg-dark py-3 d-flex justify-content-between align-items-center">
                <h2 class="text-white" style="padding-left: 20px;">Products</h2>
                <a href="{{ route('products.create') }}" class="text-white" title="Add Product">
                  <i class="fas fa-cart-plus fa-2x"></i>
                </a>
              </div>
              <div class="card-body">
                <form>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by product name">
                    <button class="btn btn-dark" type="submit">Search</button>
                  </div>
                </form>
                <div class="row">
                  @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                      <div class="col-md-6 mb-4">
                        <div class="card product-card">
                          <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                              <img width="150" height="150" src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="img-fluid product-image">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">{{$product->product}}</h5>
                                <p class="card-text"><strong>Category:</strong> {{$product->category}}</p>
                                <p class="card-text"><strong>Price:</strong> {{ number_format($product->price, 0, '.', ',') }}</p>
                                <p class="card-text"><strong>Description:</strong> {{$product->description}}</p>
                                <p class="card-text"><small class="text-muted">Created at: {{\Carbon\Carbon::parse($product->created_at)->format('d M, y')}}</small></p>
                                <div class="d-flex justify-content-start">
                                  <a href="{{route('products.edit', $product->id)}}" class="btn btn-dark me-2">Edit</a>
                                  <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-2">Delete</button>
                                  </form>
                                  <a href="#" class="btn btn-info">Show</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @else
                    <div class="col-md-12">
                      <div class="alert alert-warning">
                        No products found.
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div>
                <!-- Your content here -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
