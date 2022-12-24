<?php 
  use App\Models\Client; 
  use App\Models\Product; 
  use App\Models\Inventory; 
  use App\Models\Vendor; 
  use App\Models\BankCash; 
  use App\Models\Profit;
  use App\Models\Expense;
  use Carbon\Carbon;
?>
@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <!-- <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Welcome {{Auth::user()->name}}! 🎉</h5>
            <p class="mb-4">You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in your profile.</p>

            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <div class=" col-md-12 order-1">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('client-list')}}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Client</span>
            <h3 class="card-title mb-2">{{$client = Client::get()->count()}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('project-list')}}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Project</span>
            <h3 class="card-title mb-2">{{$project = Inventory::get()->count()}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('vendor-list')}}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Vendor</span>
            <h3 class="card-title mb-2">{{$vendor = Vendor::get()->count()}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('product-list')}}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Product</span>
            <h3 class="card-title mb-2">{{$product = Product::get()->count()}}</h3>
          </div>
        </div>
      </div>
    
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('account-cashbook')}}">View More</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Today's Expense</span>
            <h3 class="card-title text-nowrap mb-1">৳{{$balance = Profit::whereDate('created_at', now())->groupBy('created_at')->where('type','dr')->sum('total')}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('account-cashbook')}}">View More</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Last 7 days Expense</span>
            <h3 class="card-title mb-2">৳<?php $date = Carbon::now()->subDays(7);?>{{$balance = Profit::where('created_at', '>=', $date)->where('type','dr')->sum('total')}}</h3>
            <!-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +72.80%</small> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('account-cashbook')}}">View More</a>
                </div>
              </div>
            </div>
            <?php $orders = Profit::where('type','dr')->select(
                        DB::raw('sum(total) as sums'), 
                        DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
                        DB::raw("DATE_FORMAT(created_at,'%m') as monthKey")
              )
              ->groupBy('months', 'monthKey')
              ->get();?>
              @foreach($orders as $order)@endforeach
            <span class="fw-semibold d-block mb-1">This month Expense</span>
            <h3 class="card-title mb-2">৳{{$order->sums}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('account-cashbook')}}">View More</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Last month Expense</span>
            <h3 class="card-title mb-2">৳{{$balance = Profit::where(DB::raw('created_at >= DATE_SUB(NOW(),INTERVAL 1 MONTH)'))->sum('total')}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="{{route('account-ledger-search')}}">View More</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Today's Profit</span>
            <h3 class="card-title mb-2">৳{{$balance = Profit::whereDate('created_at', now())->groupBy('created_at')->where('type','cr')->sum('total')}}</h3>
           <!--  <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="{{route('account-ledger-search')}}">View More</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                </div>
              </div>
            </div>
            <span style="font-size: .86rem">Last 7 days Profit</span>
            <h3 class="card-title text-nowrap mb-1">৳<?php $date = Carbon::now()->subDays(7);?>{{$balance = Profit::where('created_at', '>=', $date)->where('type','cr')->sum('total')}}</h3>
           <!--  <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small> -->
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="{{route('account-ledger-search')}}">View More</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                </div>
              </div>
            </div>
            <?php $orders = Profit::where('type','cr')->select(
                        DB::raw('sum(total) as sums'), 
                        DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
                        DB::raw("DATE_FORMAT(created_at,'%m') as monthKey")
              )
              ->groupBy('months', 'monthKey')
              ->get();?>
              @foreach($orders as $order)@endforeach
            <span class="fw-semibold d-block mb-1">This month Profit</span>
            <h3 class="card-title mb-2">৳{{$order->sums}}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="{{route('account-ledger-search')}}">View More</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Last month Profit</span>
            <h3 class="card-title text-nowrap mb-1">৳{{$balance = Profit::where(DB::raw('created_at >= DATE_SUB(NOW(),INTERVAL 1 MONTH)'))->sum('total')}}</h3>
           <!--  <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
