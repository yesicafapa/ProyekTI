<div class="col-span-12 xl:col-span-7">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Tambah Admin Baru
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola akses tim cv_seovdetech</p>
            </div>
            
            <form action="{{ route('user.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Contoh: Budi Admin" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-blue-500 dark:border-gray-700 dark:text-white" required />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" placeholder="admin@seovdetech.com" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-blue-500 dark:border-gray-700 dark:text-white" required />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-blue-500 dark:border-gray-700 dark:text-white" required />
                    </div>   

                    <button type="submit" class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Simpan Admin
                    </button>
                </div>
            </form>
        </div>
    </div>