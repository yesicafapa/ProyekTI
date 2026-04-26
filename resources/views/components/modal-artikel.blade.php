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
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black italic tracking-tighter text-slate-800 uppercase dark:text-white" x-text="editMode ? 'EDIT ARTIKEL' : 'TAMBAH ARTIKEL'"></h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-gray-500">Kelola konten informasi digital</p>
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

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-12">
                        {{-- Kolom Kiri --}}
                        <div class="space-y-6 md:col-span-7">
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Judul Artikel</label>
                                <input type="text" name="judul" x-model="formData.judul" placeholder="Tulis judul yang menarik..." required 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                            </div>

                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Ringkasan Artikel</label>
                                <textarea name="ringkasan" x-model="formData.ringkasan" rows="3" placeholder="Tulis ringkasan singkat untuk headline..." required 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white"></textarea>
                            </div>

                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Konten Lengkap</label>
                                <textarea name="isi" x-model="formData.isi" rows="8" placeholder="Mulai menulis konten di sini..." required 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white"></textarea>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="space-y-6 md:col-span-5">
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Status Publikasi</label>
                                <div class="relative group">
                                    <select name="status" x-model="formData.status" 
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 pr-12 text-sm font-black text-slate-800 outline-none focus:border-orange-500 transition-all appearance-none cursor-pointer dark:border-white/10 dark:bg-white/5 dark:text-white">
                                        
                                        {{-- BAGIAN FIX: Dipaksa teks gelap & bg putih agar terlihat di semua browser --}}
                                        <option value="1" class="text-slate-900 bg-white">TERBITKAN SEKARANG</option>
                                        <option value="0" class="text-slate-900 bg-white">SIMPAN SEBAGAI DRAFT</option>
                                        
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 group-hover:text-orange-500 transition-colors">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Thumbnail Image</label>
                                <div class="group relative aspect-[4/3] w-full overflow-hidden rounded-[2rem] border-2 border-dashed border-slate-200 bg-slate-50 hover:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5">
                                    <img :src="imageUrl" x-show="imageUrl" class="h-full w-full object-cover">
                                    <div x-show="!imageUrl" class="flex h-full flex-col items-center justify-center text-slate-400 dark:text-gray-500">
                                        <svg class="mb-2 h-10 w-10 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="text-[9px] font-black uppercase tracking-[0.2em]">Upload Thumbnail</span>
                                    </div>
                                    <input type="file" name="thumbnail" class="absolute inset-0 cursor-pointer opacity-0" @change="const file = $event.target.files[0]; if (file) { imageUrl = URL.createObjectURL(file); }">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-10 flex items-center justify-end gap-6 border-t border-slate-100 pt-8 dark:border-white/5">
                        <button type="button" @click="openModal = false" class="text-[10px] font-black text-slate-400 hover:text-slate-800 uppercase tracking-widest transition-colors dark:hover:text-white">Batal</button>
                        <button type="submit" class="rounded-2xl bg-orange-500 px-12 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-orange-500/20 hover:bg-orange-600 active:scale-95 transition-all">
                            <span x-text="editMode ? 'Simpan Perubahan' : 'Terbitkan Sekarang'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>