<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <link href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" rel="stylesheet" />
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ url('/home') }}">BINARY</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
        </nav>
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ url('/home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            @if($user->permission == 'ADMIN')
                                <a class="nav-link" href="{{ url('/books') }}">
                                    <div class="sb-nav-link-icon"><i class="fa fa-book-open"></i></div>
                                    Books
                                </a>

                                <a class="nav-link" href="{{ url('/request/books/admin') }}">
                                    <div class="sb-nav-link-icon"><i class="fa fa-book-open"></i></div>
                                    Book Request
                                </a>
                            @endif

                            @if($user->permission == 'USER')
                                <a class="nav-link" href="{{ url('/request/books/user') }}">
                                    <div class="sb-nav-link-icon"><i class="fa fa-book-open"></i></div>
                                    Book Request
                                </a>
                            @endif


                            <a class="nav-link" href="javascript:void" id="logout-button">
                                <div class="sb-nav-link-icon"><i class="fa fa-power-off"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ $user->name }} {{ '('.$user->permission.')' }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                @yield('content')
            </div>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#logout-button').click(function (){
                    $('#logout-form').submit();
                }); 

                $('#data-table').DataTable();
            });
        </script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        
    </body>
</html>
