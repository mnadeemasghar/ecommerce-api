<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <!-- Add your CSS styles or include a stylesheet here -->
    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('/js/bootstrap.js')}}"></script>
</head>
<body>
    <header>
        <!-- Add navigation or other header content here -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories')}}">Category</a>
                </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container mt-5">
            @yield('content')
        </div>
    </main>

    <footer>
        <!-- Add footer content here -->
    </footer>

    <!-- Add your JavaScript scripts or include scripts here -->
</body>
</html>
