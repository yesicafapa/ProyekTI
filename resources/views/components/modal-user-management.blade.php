<template x-teleport="body">
    <div x-show="openModal" 
         class="fixed inset-0 z-[10000] flex items-center justify-center bg-slate-900/60 backdrop-blur-md p-4 dark:bg-[#0d0d0d]/80"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-cloak>
        
        <div x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             @click.away="openModal = false"
             class="relative w-full max-w-5xl overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-2xl font-['Poppins'] transition-colors duration-300 dark:border-white/10 dark:bg-[#1a1a1a] dark:shadow-black/50">
            
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/50 px-10 py-8 dark:border-white/5 dark:bg-white/[0.02]">
                <div class="flex items-center gap-5">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black italic tracking-tighter text-slate-800 uppercase dark:text-white" x-text="editMode ? 'EDIT DATA ADMIN' : 'TAMBAH ADMIN BARU'"></h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-gray-500">Kelola informasi akun administrator sistem</p>
                    </div>
                </div>
                <button @click="openModal = false" class="group flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-red-500 hover:text-white transition-all dark:bg-white/5 dark:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-10 max-h-[80vh] overflow-y-auto custom-scrollbar">
                <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                    @csrf
                    <template x-if="editMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="grid grid-cols-1 gap-10 md:grid-cols-12">
                        {{-- Kolom Kiri: Informasi Akun --}}
                        <div class="space-y-6 md:col-span-7">
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Nama Lengkap</label>
                                <input type="text" name="nama" x-model="formData.nama" placeholder="Masukkan nama lengkap..." required 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                            </div>

                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Alamat Email</label>
                                <input type="email" name="email" x-model="formData.email" placeholder="contoh: admin@seovdetech.com" required 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                            </div>

                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Kata Sandi</label>
                                <input type="password" name="password" x-model="formData.password" :required="!editMode" placeholder="••••••••" 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                                <p x-show="editMode" class="mt-3 flex items-center gap-2 text-[10px] text-slate-400 italic font-medium dark:text-gray-500">
                                    <svg class="h-3 w-3 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg>
                                    Kosongkan jika tidak ingin mengubah password.
                                </p>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Akses & Foto --}}
                        <div class="space-y-6 md:col-span-5">
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Level Akses</label>
                                <div class="relative group">
                                    <select name="level" x-model="formData.level" 
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 pr-12 text-sm font-black text-slate-800 outline-none focus:border-orange-500 transition-all appearance-none cursor-pointer dark:border-white/10 dark:bg-white/5 dark:text-white">
                                        <option value="admin" class="text-slate-900 bg-white">ADMIN</option>
                                        <option value="super admin" class="text-slate-900 bg-white">SUPER ADMIN</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 group-hover:text-orange-500 transition-colors">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Foto Profil Admin</label>
                                <div class="group relative aspect-square w-full max-w-[260px] mx-auto overflow-hidden rounded-[2.5rem] border-2 border-dashed border-slate-200 bg-slate-50 hover:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5">
                                    <img :src="imageUrl" x-show="imageUrl" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div x-show="!imageUrl" class="flex h-full flex-col items-center justify-center text-slate-400 dark:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 h-12 w-12 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-center px-6">Upload Foto Profil</span>
                                    </div>
                                    <input type="file" name="foto" class="absolute inset-0 cursor-pointer opacity-0" @change="const file = $event.target.files[0]; if (file) imageUrl = URL.createObjectURL(file)">
                                </div>
                                <p class="mt-4 text-center text-[9px] font-bold text-slate-400 uppercase tracking-widest dark:text-gray-500">*Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-10 flex items-center justify-end gap-6 border-t border-slate-100 pt-8 dark:border-white/5">
                        <button type="button" @click="openModal = false" class="text-[10px] font-black text-slate-400 hover:text-slate-800 uppercase tracking-widest transition-colors dark:hover:text-white">Batal</button>
                        <button type="submit" class="rounded-2xl bg-orange-500 px-12 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-orange-500/20 hover:bg-orange-600 active:scale-95 transition-all">
                            <span x-text="editMode ? 'Simpan Perubahan' : 'Daftarkan Admin'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>