<x-main_admin_layout>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="row mt-2">
                @if (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'teamLeader' )
                    <div class="col-sm-4 mb-2">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Users</h5>
                                <h3 class="mt-3 mb-3">{{ $userCount}}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                @endif
                <div class="col-sm-4 mb-2">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Projects</h5>
                            <h3 class="mt-3 mb-3">{{$projectCount}}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Complete Task</h5>
                            <h3 class="mt-3 mb-3">{{$taskCompleteCount}}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> 
                <div class="col-sm-4 mb-2">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Pending Task</h5>
                            <h3 class="mt-3 mb-3">{{$taskInCompleteCount}}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div> <!-- end col -->
    </div>
</x-main_admin_layout>