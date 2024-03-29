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
        <div class='container mx-auto px-10 py-4 font-semibold'>
            <h3 class='text-lg mb-4'>Hotels</h3>
                <form action="/hotel/search/param" method="GET">
                    <input type="text" name="name" id="name" class="rounded w-5/6 h-10 p-2 m-2" required>
                    <button class='btn btn-outline btn-sm' type="submit">Search</button>
                </form>
                <div class='overflow-x-auto w-full'>
                    <table class='table w-full'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Hotel Name</th>
                                <th class="px-1">Capacity</th>
                                <th class="px-1">View</th>
                                <th class="px-1">Edit</th>
                                <th class="px-1">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotels as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td><img src="{{ $item['image'] }}" class="w-24"></td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['capacity'] }}</td>
                                    <td>
                                        <div class='hover:bg-orange-700 w-fit p-2 rounded-full'>
                                            <a href="/hotel/{{ $item['id'] }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='hover:bg-orange-700 w-fit p-2 rounded-full'>
                                            <a href="/updatehotel/{{ $item['id'] }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='hover:bg-orange-700 w-fit p-2 rounded-full'>
                                            <form action="/hotel/{{ $item['id'] }}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </body>
</html>
