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
        <div class='mx-2 sm:mx-10 py-4'>
            <div class="md:grid md:grid-cols-3">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-semibold leading-6 text-base-100">Add Hotel</h3>
                    </div>
                </div>
                <div class='mt-5 md:mt-0 md:col-span-2 bg-base-100 shadow-md overflow-hidden rounded-lg'>
                    <form action="/hotel" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-12 gap-6">
                                    <div class="col-span-12 sm:col-span-6">
                                        <input type="hidden" id="id" name="id" value="{{ $hotel['id']}}">
                                        <label htmlFor="name" class="block text-sm font-semibold">
                                            Nama Hotel
                                        </label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            autoComplete="given-name"
                                            class="mt-1 input input-sm input-bordered w-full max-w-lg"
                                            value="{{ $hotel['name'] }}"    
                                        >
                                    </div>

                                    <div class="col-span-12">
                                        <label htmlFor="lat" class="block text-sm font-semibold">
                                            Lat
                                        </label>
                                        <input
                                            type="text"
                                            name="lat"
                                            id="lat"
                                            autoComplete="street-address"
                                            class="mt-1 input input-sm input-bordered w-full"
                                            value="{{ $hotel['lat'] }}"    
                                        >
                                    </div>
                                    <div class="col-span-12">
                                        <label htmlFor="lot" class="block text-sm font-semibold">
                                            Lot
                                        </label>
                                        <input
                                            type="text"
                                            name="lot"
                                            id="lot"
                                            autoComplete="street-address"
                                            class="mt-1 input input-sm input-bordered w-full"
                                            value="{{ $hotel['lot'] }}"    
                                        >
                                    </div>
                                    <div class="col-span-12">
                                        <label htmlFor="description" class="block text-sm font-semibold">
                                            Deskripsi
                                        </label>
                                        <textarea
                                            name="description"
                                            id="description"
                                            class="mt-1 textarea textarea-bordered w-full" 
                                            value="{{ $hotel['description'] }}"      
                                        ></textarea>
                                    </div>
                                    <div class="col-span-12">
                                        <label htmlFor="image" class="block text-sm font-semibold">
                                            Foto Hotel
                                        </label>
                                        <div class='flex mt-1 justify-center px-6 pt-5 pb-6 border-2 border-base-content border-dashed rounded-md'>
                                            <input multiple type="file" accept="image/*" >
                                        </div>
                                    </div>
                                    <div class='col-span-12 flex justify-end'>
                                        <input type='submit' class='btn' value="Submit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
