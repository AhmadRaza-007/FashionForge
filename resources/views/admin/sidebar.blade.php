<div class="dashboard-nav">
    <header class="sidebar_header">
        <a href="{{ route('admin.dashboard') }}" class="menu-toggle"><i class="fas fa-bars"></i>
        </a>
        <a href="#" class="brand-logo">
            <i class="fas fa-anchor"></i>
            <span>BRAND</span>
        </a>
    </header>
    <nav class="dashboard-nav-list">
        {{-- <a href="#" class="dashboard-nav-item">
            <i class="fas fa-home"></i>
            Home
        </a> --}}
        <a href="{{ route('admin.dashboard') }}"
            class="dashboard-nav-item
            @if (Route::currentRouteNamed('admin.dashboard')) active @endif">
            <i class="fas fa-tachometer-alt"></i>
            dashboard
        </a>
        <a href="{{ route('admin.clothingCollection') }}"
            class="dashboard-nav-item
            @if (Route::currentRouteNamed('admin.clothingCollection') ||
                    Route::currentRouteNamed('admin.addCollection') ||
                    Route::currentRouteNamed('admin.editCollection') ||
                    Route::currentRouteNamed('admin.updateCollection') ||
                    Route::currentRouteNamed('admin.deleteCategory')) active @endif">
            <i class="fas fa-file-upload">
            </i>
            Clothing Collection
        </a>
        {{-- <a href="{{ route('admin.subCollection') }}" class="dashboard-nav-item">
            <i class="fas fa-file-upload"></i>
            All Sub Collection
        </a> --}}
        <div class='dashboard-nav-dropdown'>
            <a
                class="dashboard-nav-item dashboard-nav-dropdown-toggle
                @if (Route::currentRouteNamed('admin.editSubCollection') ||
                        Route::currentRouteNamed('admin.subCollectionByID') ||
                        Route::currentRouteNamed('admin.addSubCollection') ||
                        Route::currentRouteNamed('admin.editSubCollection') ||
                        Route::currentRouteNamed('admin.deleteSubCategory')) active @endif">
                <i class="fas fa-photo-video"></i>
                Sub Collections
            </a>
            <div class='dashboard-nav-dropdown-menu'>
                @foreach (App\Models\Collection::get() as $collection)
                    <a href="{{ url('coll/' . $collection->id) }}" class="dashboard-nav-dropdown-item">
                        {{ $collection->name }}
                    </a>
                @endforeach
                <!-- <a href="#" class="dashboard-nav-dropdown-item">Recent</a>
                <a href="#" class="dashboard-nav-dropdown-item">Images</a>
                <a href="#" class="dashboard-nav-dropdown-item">Video</a> -->
            </div>
        </div>
        {{-- <a href="{{ route('admin.clothes') }}" class="dashboard-nav-item">
            <i class="fas fa-file-upload"></i>
            Clothes
        </a> --}}
        <div class='dashboard-nav-dropdown'>
            <a href="#!"
                class="dashboard-nav-item dashboard-nav-dropdown-toggle
            @if (Route::currentRouteNamed('admin.clothe') ||
                    Route::currentRouteNamed('admin.editClothes') ||
                    Route::currentRouteNamed('admin.updateClothes') ||
                    Route::currentRouteNamed('admin.productById') ||
                    Route::currentRouteNamed('admin.addClothes') ||
                    Route::currentRouteNamed('admin.deleteClothes') ||
                    Route::currentRouteNamed('admin.deleteClothesImage') ||
                    Route::currentRouteNamed('admin.destroySize') ||
                    Route::currentRouteNamed('admin.destroyColor') ||
                    Route::currentRouteNamed('admin.deliveredOrders')) active @endif">
                <i class="fas fa-photo-video"></i>
                Clothes
            </a>
            <div class='dashboard-nav-dropdown-menu'>

                <?php

                use App\Models\Collection;
                use App\Models\SubCollection;

                $collections = Collection::with('subCollection')->get();
                ?>

                @foreach ($collections as $collection)
                    <div class='dashboard-nav-dropdown'>

                        <a href="#" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                            {{ $collection->name }}
                        </a>

                        <div class='dashboard-nav-dropdown-menu'>
                            @foreach ($collection->subcollection as $key => $sub_collection)
                                <a href="{{ url('/admin/clothes/') . '/' . $sub_collection->id }}"
                                    class="dashboard-nav-dropdown-item"
                                    style="padding-left: 85px;">{{ $sub_collection->title }}</a>
                            @endforeach
                            <!-- <a href="#" class="dashboard-nav-dropdown-item">Images</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Video</a> -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class='dashboard-nav-dropdown'>
            <a href="#!"
                class="dashboard-nav-item dashboard-nav-dropdown-toggle
                @if (Route::currentRouteNamed('admin.users')) active @endif">
                <i class="fas fa-users"></i>
                Users
            </a>
            <div class='dashboard-nav-dropdown-menu'>
                <a href="{{ route('admin.users') }}" class="dashboard-nav-dropdown-item">All</a>
                <a href="#" class="dashboard-nav-dropdown-item">Subscribed</a>
                <a href="#" class="dashboard-nav-dropdown-item">Non-subscribed</a>
                <a href="#" class="dashboard-nav-dropdown-item">Banned</a>
                <a href="#" class="dashboard-nav-dropdown-item">New</a>
            </div>
        </div>
        <div class='dashboard-nav-dropdown'>
            <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                <i class="fas fa-money-check-alt"></i>
                Payments
            </a>
            <div class='dashboard-nav-dropdown-menu'>
                <a href="#" class="dashboard-nav-dropdown-item">All</a>
                <a href="#" class="dashboard-nav-dropdown-item">Recent</a>
                <a href="#" class="dashboard-nav-dropdown-item"> Projections</a>
            </div>
        </div>

        <div class='dashboard-nav-dropdown'>
            <a href="#!"
                class="dashboard-nav-item dashboard-nav-dropdown-toggle
            @if (Route::currentRouteNamed('admin.orders') ||
                    Route::currentRouteNamed('admin.pendingOrders') ||
                    Route::currentRouteNamed('admin.shippedOrders') ||
                    Route::currentRouteNamed('admin.deliveredOrders')) active @endif">
                <i class="fas fa-file-upload"></i>
                Orders
            </a>
            <div class='dashboard-nav-dropdown-menu'>
                <a href="{{ route('admin.orders') }}" class="dashboard-nav-dropdown-item">All</a>
                <a href="{{ route('admin.pendingOrders') }}" class="dashboard-nav-dropdown-item">Pending</a>
                <a href="{{ route('admin.shippedOrders') }}" class="dashboard-nav-dropdown-item"> Shipped</a>
                <a href="{{ route('admin.deliveredOrders') }}" class="dashboard-nav-dropdown-item"> Delivered</a>
            </div>
        </div>

        {{-- <a href="{{ route('admin.orders') }}" class="dashboard-nav-item">
            <i class="fas fa-file-upload"></i>
            Orders
        </a> --}}
        <a href="#" class="dashboard-nav-item">
            <i class="fas fa-cogs"></i>
            Settings
        </a>
        <a href="#" class="dashboard-nav-item">
            <i class="fas fa-user"></i>
            Profile
        </a>
        <div class="nav-item-divider"></div>
        <form id="adminLogout" action="{{ route('admin.postLogout') }}" method="post" style="cursor: pointer;">
            @csrf
            <a class="dashboard-nav-item" onclick="document.getElementById('adminLogout').submit()">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </form>
    </nav>
</div>
