<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        @vite('resources/css/app.css')
    </head>

    <body>
        <div class='min-h-screen flex-col flex items-center justify-center px-4 sm:px-6 lg:px-8'>
            <div class='bg-[#f1c7b2] rounded-lg shadow-2xl p-12'>
                <div class='max-w-md md:w-screen space-y-4'>
                    <img src="{{url('/logo-icon.png')}}" alt="Logo" class='w-4/12 md:w-2/12 mx-auto'>
                    <h2 class='text-center text-3xl font-bold text-[#ce6935]'>Admin Sign in</h2>
                    <form method='POST' action='/login' class="mt-8 space-y-6">
                        @csrf
                        <div class="rounded-md shadow-sm -space-y-px md:w-7/12 mx-auto">
                            <div>
                                <label htmlFor="username" class="sr-only">
                                    Username
                                </label>
                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    autoComplete="username"
                                    required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Username"
                                />
                            </div>
                            <div>
                                <label htmlFor="password" class="sr-only">
                                    Password
                                </label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autoComplete="current-password"
                                    required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Password"
                                />
                            </div>
                        </div>

                        @if ($errors->has('error'))
                            <div className='relative w-ful flex justify-end sm:w-7/12 mx-auto px-4'>
                                <p className='text-[#cc3300]'>{{$errors->first('errora')}}</p>
                            </div>
                        @endif

                        <button
                            type="submit"
                            class="relative flex mx-auto justify-center w-full md:w-7/12 py-2 px-4 border border-brown-secondary text-sm font-medium rounded-md text-[#e6e0d4] bg-[#ce6935] hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown-primary"
                        >
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                </svg>
                            </span>
                            Sign in
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
