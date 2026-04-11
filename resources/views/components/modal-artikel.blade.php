<template x-teleport="body">
    <div x-show="openModal" 
         class="fixed inset-0 z-[100000] flex items-start justify-center overflow-y-auto bg-slate-900/60 backdrop-blur-sm p-4 py-10 md:py-20"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-cloak>
        
        <div x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             @click.away="openModal = false"
             class="relative my-auto w-full max-w-4xl rounded-[2.5rem] bg-white shadow-2xl dark:bg-[#1a2233] border border-white/10">
            
            {{-- Header Modal --}}
            <div class="flex items-center justify-between border-b border-slate-100 bg-white px-10 py-8 dark:border-slate-800 dark:bg-[#1a2233] rounded-t-[2.5rem]">
                <div class="flex items-center gap-5">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white" x-text="editMode ? 'Edit Artikel' : 'Buat Artikel Baru'"></h3>
                        <p class="text-xs font-medium text-slate-400">Pastikan informasi konten sudah sesuai.</p>
                    </div>
                </div>
                <button @click="openModal = false" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all dark:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-10">
                <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <div class="grid grid-cols-1 gap-10 md:grid-cols-12">
                        {{-- Kolom Kiri --}}
                        <div class="space-y-6 md:col-span-7">
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Judul Artikel</label>
                                <input type="text" name="judul" x-model="formData.judul" placeholder="Masukkan judul..." required 
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all">
                            </div>
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Ringkasan Singkat</label>
                                <textarea name="ringkasan" x-model="formData.ringkasan" rows="3" placeholder="Garis besar artikel..." 
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all"></textarea>
                            </div>
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Konten Lengkap</label>
                                <textarea name="isi" x-model="formData.isi" rows="8" placeholder="Tulis isi artikel..." required 
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all"></textarea>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="space-y-6 md:col-span-5">
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Status Publikasi</label>
                                <select name="status" x-model="formData.status" 
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-black outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all">
                                    <option value="1" class="dark:bg-[#1a2233]">TERBITKAN SEKARANG</option>
                                    <option value="0" class="dark:bg-[#1a2233]">SIMPAN SEBAGAI DRAFT</option>
                                </select>
                            </div>
                            <div>
                                <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Thumbnail Artikel</label>
                                <div class="group relative aspect-video w-full overflow-hidden rounded-[2.5rem] border-2 border-dashed border-slate-200 bg-slate-50 hover:border-orange-500 transition-all dark:border-slate-700 dark:bg-slate-800/50">
                                    <img :src="imageUrl" x-show="imageUrl" class="h-full w-full object-cover">
                                    <div x-show="!imageUrl" class="flex h-full flex-col items-center justify-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 h-10 w-10 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-[10px] font-black uppercase tracking-widest">Klik untuk Upload</span>
                                    </div>
                                    <input type="file" name="thumbnail" class="absolute inset-0 cursor-pointer opacity-0" @change="const file = $event.target.files[0]; if (file) imageUrl = URL.createObjectURL(file)">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Modal --}}
                    <div class="mt-12 flex items-center justify-end gap-6 border-t border-slate-100 pt-10 dark:border-slate-800">
                        <button type="button" @click="openModal = false" class="text-xs font-black text-slate-400 hover:text-red-500 uppercase tracking-[0.2em] transition-colors">Batalkan</button>
                        <button type="submit" class="rounded-2xl bg-orange-500 px-14 py-5 text-xs font-black uppercase tracking-[0.2em] text-white shadow-2xl shadow-orange-500/40 hover:bg-orange-600 active:scale-95 transition-all">
                            <span x-text="editMode ? 'Update Artikel' : 'Terbitkan Artikel'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>