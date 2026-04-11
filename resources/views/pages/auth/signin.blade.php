@extends('layouts.fullscreen-layout')

@section('content')
    <div class="relative z-1 bg-white p-6 sm:p-0 dark:bg-gray-900">
        <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row dark:bg-gray-900">
            
            <div class="flex w-full flex-1 flex-col lg:w-1/2">
                <div class="mx-auto w-full max-w-md pt-15">
                </div>

                <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
                    <div>
                        <div class="mb-5 sm:mb-8 text-center lg:text-left">
                            <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800 dark:text-white/90">
                                Sign In
                            </h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Please enter your email and password to access CV SEOVDETECH admin panel.
                            </p>
                        </div>

                        @if($errors->any())
                            <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-600 dark:bg-red-900/20 dark:text-red-400">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf 
                                <div class="space-y-5">
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Email Address<span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required
                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:ring-3 focus:outline-none dark:border-gray-700 dark:text-white/90" />
                                    </div>

                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Password<span class="text-red-500">*</span>
                                        </label>
                                        <div x-data="{ showPassword: false }" class="relative">
                                            <input :type="showPassword ? 'text' : 'password'" name="password" required
                                                placeholder="Enter your password"
                                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-11 pl-4 text-sm text-gray-800 focus:border-brand-500 focus:ring-3 focus:outline-none dark:border-gray-700 dark:text-white/90" />
                                            
                                            <span @click="showPassword = !showPassword"
                                                class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500 dark:text-gray-400">
                                                <svg x-show="!showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20"><path d="M10 13.86a3.86 3.86 0 1 1 0-7.72 3.86 3.86 0 0 1 0 7.72Z"/></svg>
                                                <svg x-show="showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20"><path d="M10 4.04c-3.51 0-6.5 2.26-7.58 5.41a1 1 0 0 0 0 .5c1.08 3.15 4.07 5.41 7.58 5.41s6.5-2.26 7.58-5.41a1 1 0 0 0 0-.5c-1.08-3.15-4.07-5.41-7.58-5.41Z"/></svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                                            <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-400">Remember me</label>
                                        </div>
                                    </div>

                                    <div>
                                       <button type="submit" class="w-full py-3 bg-brand-500 text-white font-semibold rounded-lg hover:bg-brand-600 transition-all shadow-md active:scale-[0.98]">
                                        Sign In
                                       </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden w-full items-center justify-center bg-brand-500 lg:flex lg:w-1/2">
                <div class="max-w-[450px] text-center">
                    <h2 class="mb-3 text-4xl font-bold text-white">SEOVDETECH</h2>
                    <p class="font-medium text-white/80">Management System Dashboard</p>
                    <p class="mt-2 text-sm text-white/60">Trusted IT Partner for Your Business Growth</p>
                </div>
            </div>
        </div>
    </div>
@endsection