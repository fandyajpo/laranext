<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body>
    @include("layouts.header")
    <div class="flex w-full bg-gray-900">
        @include("layouts.navigation")
        <div class="flex items-center justify-center w-full">
            <div class="md:max-w-4xl lg:max-w-5xl duration-500 xl:max-w-5xl 2xl:max-w-7xl w-full flex flex-col items-stretch grow flex-shrink-0 gap-x-4">
                <div class="p-0 h-screen flex flex-col gap-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>