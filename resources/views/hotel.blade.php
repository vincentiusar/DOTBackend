<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hotels</title>

        @vite('resources/css/app.css')
    </head>

    <body>
        <div class="sticky top-0 z-50 navbar shadow-sm shadow-brown-primary px-6 bg-white">
            <div class="navbar-start">
                <div>
                    <a href='/hotel'>
                        <img src={{url('/logo-icon.png')}} alt="Logo" class='w-12' />
                    </a>
                </div>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal p-0 text-base-300 font-semibold">
                    <li tabIndex="0">
                        <a href='/hotel'>
                            Hotel
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                        </a>
                        <ul class="p-2 bg-base-content">
                            <a href='/addhotel'>
                                <li >
                                    <p class='hover:bg-primary-focus hover:bg-opacity-40 font-medium'>Add Hotel</p>
                                </li>
                            </a>
                            <a href="/hotel">
                                <li>
                                    <p class='hover:bg-primary-focus hover:bg-opacity-40 font-medium'>List Hotel</p>
                                </li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class='bg-base-100 mx-10 mt-4 shadow overflow-hidden sm:rounded-lg'>
            <div class='p-4 sm:px-6 flex justify-between'>
                <h3 class='text-lg font-semibold'>{{ $hotel['name'] }}</h3>
                <a href="/updatehotel/{{ $hotel['id'] }}">
                    <button class='btn btn-outline btn-sm'>Edit</button>
                </a>
            </div>
            <div class='border-t border-base-300'>
                <dl>
                    <div class="bg-base-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-semibold">Description</dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">{{ $hotel['description'] }}</dd>
                    </div>
                    <div class="bg-base-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-semibold">Image</dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            <div class='gap-4 grid grid-cols-2 md:grid-cols-3 py-6'>
                                <img src="{{ $hotel['image'] }}" class="w-56">
                            </div>
                        </dd>
                    </div>
                    <div class="bg-base-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-semibold">Location</dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">{{ $hotel['lat']}}, {{ $hotel['lot'] }}</dd>
                    </div>
                    <div class="bg-base-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-semibold">Capacity</dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">capacity</dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class='mt-8 mx-10'>
            <div class='flex justify-between'>
                <h3 class='text-lg font-semibold mb-2'>Room Details</h3>
                <a href="/addroom/{{ $hotel['id'] }}">
                    <div class='btn'>Add Room</div>
                </a>
            </div>
            <div class='grid grid-cols-1 lg:grid-cols-2 gap-4'>
                @foreach ($rooms as $item)
                    <div class="bg-base-100 sm:rounded-lg mt-2 md:flex border border-white rounded mb-6">
                        <div class='md:max-w-xs'>
                            <img src="{{ $item['image'] }}">
                        </div>
                        <div class='m-4 md:w-full'>
                            <div class='flex items-center gap-x-4'>
                                <h1 class='text-lg font-semibold'>{{ $item['name'] }}</h1>
                                <div class='badge lg:badge-xs badge-lg'>Rp.{{ $item['price'] }}</div>
                            </div>
                            <p class='mt-2'>{{ $item['description'] }}</p>
                            <div class='flex gap-x-4 justify-end mt-20'>
                                <form action="/{{ $hotel['id'] }}/room/{{ $item['id'] }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button class='btn btn-outline btn-sm' type="submit">Delete</button>
                                </form>
                                <a href='/updateroom/{{ $item['id'] }}'>
                                    <div class='btn btn-outline btn-sm'>Edit</div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                    
            </div>
        </div>
    </body>
</html>
