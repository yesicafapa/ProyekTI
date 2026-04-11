<div x-data="{ open: false }">
    <div class="mb-6 rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
            <div class="flex w-full flex-col items-center gap-6 xl:flex-row">
                <div class="h-20 w-20 flex items-center justify-center rounded-full bg-brand-500 text-white text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                </div>
                
                <div class="order-3 xl:order-2 text-center xl:text-left">
                    <h4 class="mb-2 text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ auth()->user()->nama }}
                    </h4>
                    <div class="flex flex-col items-center gap-1 xl:flex-row xl:gap-3">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ ucfirst(auth()->user()->level) }}
                        </p>
                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>
            </div>

            <button @click="open = true"
                class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 lg:inline-flex lg:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206Z"/>
                </svg>
                Edit Profil
            </button>
        </div>
    </div>

    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" x-cloak>
        <div class="relative w-full max-w-[700px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11 shadow-xl">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Informasi Akun</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Update data diri atau ganti password akun kamu.</p>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    <div class="col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ auth()->user()->nama }}" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:text-white">
                    </div>

                    <div class="col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email Address</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Password Baru</label>
                        <input type="password" name="password" placeholder="Isi jika ingin ganti"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:text-white">
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-8 lg:justify-end">
                    <button @click="open = false" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 border rounded-lg hover:bg-gray-50">Close</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">Save Changes</button>
                </div>
            </form>
            </div>
    </div>
</div>