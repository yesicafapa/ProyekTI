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
             class="relative my-auto w-full max-w-2xl rounded-[2.5rem] bg-white shadow-2xl dark:bg-[#1a2233] border border-white/10">
            
            {{-- Header Modal --}}
            <div class="flex items-center justify-between border-b border-slate-100 bg-white px-10 py-8 dark:border-slate-800 dark:bg-[#1a2233] rounded-t-[2.5rem]">
                <div class="flex items-center gap-5">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white" x-text="editMode ? 'Edit FAQ' : 'Tambah FAQ Baru'"></h3>
                        <p class="text-xs font-medium text-slate-400">Kelola daftar tanya jawab layanan.</p>
                    </div>
                </div>
                <button @click="openModal = false" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all dark:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-10">
                <form :action="actionUrl" method="POST">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <div class="space-y-6">
                        {{-- Input Pertanyaan --}}
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Pertanyaan</label>
                            <input type="text" name="pertanyaan" x-model="formData.pertanyaan" placeholder="Apa yang sering ditanyakan pelanggan?" required 
                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all">
                        </div>

                        {{-- Input Jawaban --}}
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Jawaban</label>
                            <textarea name="jawaban" x-model="formData.jawaban" rows="5" placeholder="Berikan penjelasan yang singkat dan padat..." required 
                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all"></textarea>
                        </div>

                        {{-- Status Publikasi --}}
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-slate-400">Status Publikasi</label>
                            <select name="status" x-model="formData.status" 
                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-black outline-none focus:border-orange-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-white transition-all">
                                <option value="1" class="dark:bg-[#1a2233]">AKTIF (TAMPILKAN)</option>
                                <option value="0" class="dark:bg-[#1a2233]">DRAFT (SEMBUNYIKAN)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Footer Modal --}}
                    <div class="mt-12 flex items-center justify-end gap-6 border-t border-slate-100 pt-10 dark:border-slate-800">
                        <button type="button" @click="openModal = false" class="text-xs font-black text-slate-400 hover:text-red-500 uppercase tracking-[0.2em] transition-colors">Batalkan</button>
                        <button type="submit" class="rounded-2xl bg-orange-500 px-14 py-5 text-xs font-black uppercase tracking-[0.2em] text-white shadow-2xl shadow-orange-500/40 hover:bg-orange-600 active:scale-95 transition-all">
                            <span x-text="editMode ? 'Update FAQ' : 'Simpan FAQ'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>