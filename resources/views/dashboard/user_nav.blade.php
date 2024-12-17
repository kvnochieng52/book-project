{{-- <div class=" myaccount-tab-menu nav" role="tablist">
    <a href="/dashboard" class="active"><i class="fa fa-dashboard"></i>
        Dashboard</a>
    <a href="/book/submit-book"><i class="fa fa-cart-arrow-down"></i> Submit A book</a>
    <a href="/dashboard/your-books"><i class="fa fa-cloud-download"></i> Your Books</a>
    <a href="/dashboard/your-orders"><i class="fa fa-cloud-download"></i> Orders</a>
    <a href="/profile/account"><i class="fa fa-user"></i> Account Details</a>
    <a href="/logout"><i class="fa fa-sign-out"></i> Logout</a>
</div> --}}

<nav style="padding-top: 20px; padding-bottom:20px">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-secondary" href="/dashboard"
                style="border-radius: 0; border-right:1px solid #ccc"><strong><i class="fas fa-dashboard"></i>
                </strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-secondary" href="/book/submit-book"
                style="border-radius: 0; border-right:1px solid #ccc"><strong><i class="fas fa-plus"></i>
                    Submit
                    Book</strong></a>
        </li>

        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-secondary" href="/dashboard/your-books"
                style="border-radius: 0; border-right:1px solid #ccc"><strong><i class="fas fa-book"></i> Your
                    Books</strong></a>
        </li>


        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-secondary" href="/dashboard/mini-search"
                style="border-radius: 0;border-right:1px solid #ccc"><strong><i class="fas fa-search"></i> Search
                    Books</strong></a>
        </li>


        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-secondary" href="/dashboard/your-orders"
                style="border-radius: 0;"><strong><i class="fas fa-list"></i> Orders</strong></a>
        </li>


        @can('is_sales_manager')

        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-secondary" href="/reports/index" style="border-radius: 0;"><strong><i
                        class="fas fa-file"></i> Reports</strong></a>
        </li>

        @endcan




        {{-- <li class="nav-item">
            <a class="nav-link" href="/profile/account"><strong><i class="fas fa-user"></i>
                    SETTINGS</strong></a>
        </li> --}}

    </ul>
</nav>