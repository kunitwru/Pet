<html lang="en">
<head>
    @include('layout.partials.head', ['title' => isset($model->name) ? $model->name : 'Homepage'])
</head>
<body>
    @include('layout.partials.nav')
    @include('layout.partials.header')
    <main role="main">
        @yield('content')
    </main>
    @include('layout.partials.footer')
    @include('layout.partials.footer-scripts')
</body>
</html>
