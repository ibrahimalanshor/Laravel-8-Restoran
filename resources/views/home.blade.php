@extends('__layouts.app', ['url' => ['Dashboard']])

@section('title', 'Dashboard')

@section('content')

<div class="col">
<div class="ecommerce-widget">

    <div class="row">
        <!-- ============================================================== -->
        <!-- sales  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Total Orders</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $totalOrders }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end sales  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- new customer  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Total Menus</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $totalMenus }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end new customer  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- visitor  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Total Tables</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $totalTables }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end visitor  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- total orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Active Orders</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $activeOrders }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end total orders  -->
        <!-- ============================================================== -->
    </div>
    
    <div class="row">
        <!-- ============================================================== -->
        <!-- total revenue  -->
        <!-- ============================================================== -->

        
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- category revenue  -->
        <!-- ============================================================== -->
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Top Menu</h5>
                <div class="card-body">
                    <canvas id="topMenu"></canvas>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end category revenue  -->
        <!-- ============================================================== -->

        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header"> Grafik Order</h5>
                <div class="card-body">
                    <canvas id="totalRevenue"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ============================================================== -->
  
        <!-- ============================================================== -->

                      <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-lg-12 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Recent Orders</h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">No Table</th>
                                    <th class="border-0">Menu</th>
                                    <th class="border-0">Active</th>
                                    <th class="border-0">Order Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->table->no }}</td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($order->menu as $menu)
                                                    <li>{{ $menu->name }} <span class="badge badge-secondary ml-1">{{ $menu->pivot->qty }}</span></li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $order->active ? 'success' : 'primary' }}">{{ $order->active ? 'Active' : 'Not Active' }}</span>
                                        </td>
                                        <td>
                                            {{ normalDate($order->created_at) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order->code) }}" class="btn btn-xs btn-warning">Invoice</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" align="center">Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end recent orders  -->

    </div>

</div>
</div>

@endsection

@push('scripts')

    <script src="{{ asset('concept-master/vendor/charts/charts-bundle/Chart.bundle.js') }}"></script>

    <script>
        let topMenuUrl = '{{ route("top.menu") }}'
        let totalRevenueUrl = '{{ route("total.revenue") }}'
        let csrf = '{{ csrf_token() }}'
    </script>

    <script src="{{ asset('js/dashboard.js') }}"></script>

@endpush
