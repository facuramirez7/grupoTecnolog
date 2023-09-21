<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/logosGt/gt-color-16.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/logosGt/gt-color-32.png') }}" />

    <title>{{ config('app.name', 'Grupo Tecnolog') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Styles -->
    <style>
        .inputs {
            line-height: 12px !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 flex flex-col min-h-screen">
    <x-banner />

    <div class="flex-grow">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
                    <a href="/dashboard"><img src="{{ asset('/img/logosGt/gt-color-32.png') }}" sizes="32x32"
                            alt="GT"></a> {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">{{ date("Y")}} <a
                            href="https://grupotecnolog.com/" target="_blank" class="hover:underline" style="color: #0098CC">Grupo Tecnolog SA™</a>. All Rights Reserved.
                    </span>
                </li>
            </ul>

            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <img src="{{ asset('/img/logosGt/gt.png') }}" class="h-8" alt="">
                </li>
            </ul>
        </div>
    </footer>

    @stack('modals')

    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    @stack('js')
</body>

</html>
