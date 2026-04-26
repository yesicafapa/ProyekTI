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
             class="relative w-full max-w-2xl overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-2xl font-['Poppins'] transition-colors duration-300 dark:border-white/10 dark:bg-[#1a1a1a] dark:shadow-black/50">
            
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/50 px-10 py-8 dark:border-white/5 dark:bg-white/[0.02]">
                <div class="flex items-center gap-5">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black italic tracking-tighter text-slate-800 uppercase dark:text-white" x-text="editMode ? 'EDIT FAQ' : 'TAMBAH FAQ'"></h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-gray-500">Kelola daftar tanya jawab layanan</p>
                    </div>
                </div>
                <button @click="openModal = false" class="group flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-red-500 hover:text-white transition-all dark:bg-white/5 dark:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-10 max-h-[80vh] overflow-y-auto custom-scrollbar">
                <form :action="actionUrl" method="POST">
                    @csrf
                    <template x-if="editMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="space-y-6">
                        {{-- Input Pertanyaan --}}
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Pertanyaan</label>
                            <input type="text" name="pertanyaan" x-model="formData.pertanyaan" placeholder="Apa yang sering ditanyakan pelanggan?" required 
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                        </div>

                        {{-- Input Jawaban --}}
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Jawaban</label>
                            <textarea name="jawaban" x-model="formData.jawaban" rows="6" placeholder="Berikan penjelasan yang singkat dan padat..." required 
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white"></textarea>
                        </div>

                        {{-- Status Publikasi --}}
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-orange-500/80">Status Publikasi</label>
                            <div class="relative group">
                                <select name="status" x-model="formData.status" 
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 pr-12 text-sm font-black text-slate-800 outline-none focus:border-orange-500 transition-all appearance-none cursor-pointer dark:border-white/10 dark:bg-white/5 dark:text-white">
                                    
                                    <option value="1" class="text-slate-900 bg-white">AKTIF (TAMPILKAN)</option>
                                    <option value="0" class="text-slate-900 bg-white">DRAFT (SEMBUNYIKAN)</option>
                                    
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 group-hover:text-orange-500 transition-colors">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-10 flex items-center justify-end gap-6 border-t border-slate-100 pt-8 dark:border-white/5">
                        <button type="button" @click="openModal = false" class="text-[10px] font-black text-slate-400 hover:text-slate-800 uppercase tracking-widest transition-colors dark:hover:text-white">Batal</button>
                        <button type="submit" class="rounded-2xl bg-orange-500 px-12 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-orange-500/20 hover:bg-orange-600 active:scale-95 transition-all">
                            <span x-text="editMode ? 'Simpan Perubahan' : 'Terbitkan FAQ'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>