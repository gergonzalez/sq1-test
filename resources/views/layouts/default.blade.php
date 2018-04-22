<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('components.head')
    </head>
    <body>
        <div id="app">
            <header>
                @include('components.header')
            </header>

            <main>
                @yield('content')
            </main>

            <footer>
                @include('components.footer')
            </footer>
        </div>
    </body>
</html>
