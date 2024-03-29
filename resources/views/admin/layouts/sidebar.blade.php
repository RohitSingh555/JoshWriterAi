<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="User Image" style="height: 50px; width: 50px;">
            </div>
            <div class="info">
                <a type="button" data-toggle="modal" data-target="#modal-image"
                    class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.get') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{ route('allowed_users.get') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Allowed Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('token.get') }}" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Token Setting
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<section class="content">
    <div class="modal fade" id="modal-image">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Profile Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateprofile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 style="text-align: center;margin-top: 20px; ">Change Account Info</h2>
                        <label for="">First Name</label>
                        <input type="text" value="{{ Auth::user()->name }}" name="name" class="form-control">
                        <label for="">Email</label>
                        <input type="text" value="{{ Auth::user()->email }}" readonly class="form-control">
                        <h2 style="text-align: center;margin-top: 20px; ">Change Password</h2>
                        <label for="">Old Password</label>
                        <input type="password" class="form-control" name="old_password"
                            placeholder="Enter Old Password">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
