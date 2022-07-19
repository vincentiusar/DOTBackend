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
            <form method="POST" action="/room">
                @csrf
                @method("PUT")
                <div class='p-4 sm:px-6 flex justify-between'>
                    <h3 class='text-lg font-semibold'>Edit Room</h3>
                    <button class='btn btn-outline btn-sm' type="submit">Save</button>
                </div>
                <div class='border-t border-base-300'>
                    <dl>
                        <div class="bg-base-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-semibold">Name</dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    autoComplete="given-name"
                                    class="mt-1 input input-sm input-bordered w-full"
                                    value="{{ $room['name'] }}"
                                />
                            </dd>
                        </div>
                        <div class="bg-base-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-semibold">Description</dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                <textarea
                                    type="text"
                                    name="description"
                                    id="description"
                                    class="mt-1 textarea textarea-bordered w-full"
                                    value="{{ $room['description'] }}"
                                ></textarea>
                            </dd>
                        </div>
                        <div class="bg-base-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-semibold">Image</dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                <div>
                                    <label htmlFor="image" class="block text-sm font-semibold">
                                        Foto Ruangan
                                    </label>
                                    <div class='flex mt-1 justify-center px-6 pt-5 pb-6 border-2 border-base-content border-dashed rounded-md'>
                                        <div class='flex mt-1 justify-center px-6 pt-5 pb-6 border-2 border-base-content border-dashed rounded-md'>
                                            <input multiple type="file" accept="image/*" >
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        <div class="bg-base-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-semibold">Capacity</dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                <input
                                    type="text"
                                    name="capacity"
                                    id="capacity"
                                    class="mt-1 input input-sm input-bordered w-full max-w-lg"
                                    value={{ $room['capacity'] }}
                                />
                            </dd>
                        </div>
                        <div class="bg-base-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-semibold">Price</dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                <input
                                    type="text"
                                    name="price"
                                    id="price"
                                    class="mt-1 input input-sm input-bordered w-full max-w-lg"
                                    value={{ $room['price'] }}
                                />
                            </dd>
                        </div>
                        <input type="hidden" name="hotel_id" id="hotel_id" value="{{ $room['hotel_id'] }}">
                        <input type="hidden" name="id" id="id" value="{{ $room['id'] }}">
                    </dl>
                </div>
                </div>  
            </form>
        </div>
    </body>
</html>
