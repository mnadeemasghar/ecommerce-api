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
