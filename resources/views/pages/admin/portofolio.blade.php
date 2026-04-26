@extends('layouts.app')

@section('content')
{{-- Load Google Font Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; }
    [x-cloak] { display: none !important; }
    
    /* Scrollbar halus untuk area tabel */
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }
    
    .swal2-container { z-index: 99999 !important; }
</style>

<div class="mx-auto max-w-screen-2xl p-4 md:p-6" 
     x-data="portofolioManager()" 
     x-cloak>

    {{-- Notifikasi Berhasil --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-6 flex items-center gap-3 rounded-2xl bg-emerald-500/10 p-4 text-emerald-500 border border-emerald-500/20 shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">Portofolio Kami</h2>
            <p class="text-slate-500 dark:text-slate-400 font-medium mt-1">Kelola mahakarya digital CV SEOVDETECH</p>
        </div>
        <button @click="openTambah()" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-8 py-4 text-center font-bold text-white shadow-xl shadow-orange-500/30 hover:bg-orange-600 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path d="M12 4v16m8-8H4" />
            </svg>
            Tambah Portofolio
        </button>
    </div>

    {{-- Tabel Utama --}}
    <div class="overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm transition-colors duration-300 dark:border-white/5 dark:bg-[#0f1115] dark:shadow-2xl">
        <div class="overflow-x-auto custom-scrollbar">
            {{-- min-w menjaga layout agar tidak 'gepeng' saat dibuka di HP --}}
            <table class="w-full min-w-[850px] text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 dark:bg-white/[0.02] dark:border-white/5">
                        <th class="px-10 py-7 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">PROJECT</th>
                        <th class="px-10 py-7 text-center text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">STATUS</th>
                        <th class="px-10 py-7 text-right text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">OPSI KELOLA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/[0.03]">
                    @forelse($portofolios as $item)
                    <tr class="group hover:bg-slate-50/50 transition-all duration-300 dark:hover:bg-white/[0.01]">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-6">
                                {{-- Thumbnail --}}
                                <div class="h-16 w-24 flex-shrink-0 overflow-hidden rounded-2xl border border-slate-200 shadow-sm dark:border-white/10 dark:shadow-lg">
                                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/img/no-image.png') }}" 
                                         class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                                {{-- Info --}}
                                <div class="flex flex-col gap-1">
                                    <div class="text-[15px] font-bold text-slate-800 leading-tight transition-colors group-hover:text-orange-500 dark:text-white">
                                        {{ $item->judul }}
                                    </div>
                                    <div class="flex items-center gap-2 text-[12px] font-medium">
                                        <span class="text-blue-500 font-bold uppercase tracking-wider text-[11px]">Admin</span>
                                        <span class="text-slate-300 dark:text-slate-700">•</span>
                                        <a href="{{ $item->url }}" target="_blank" class="text-slate-500 dark:text-slate-400 hover:text-orange-500 underline underline-offset-4">
                                            {{ Str::limit($item->url, 40) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-6 text-center">
                            @if($item->status == 1)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-4 py-1.5 text-[10px] font-black tracking-widest text-emerald-600 border border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    PUBLISHED
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-500 border border-slate-200 dark:bg-white/5 dark:text-slate-400 dark:border-white/10">
                                    DRAFTING
                                </span>
                            @endif
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button @click="openEdit({{ json_encode($item) }})" 
                                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 transition-all dark:border-white/10 dark:hover:bg-orange-500/5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                
                                <form action="{{ route('portofolio.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" @click="confirmDeletePorto($event)" 
                                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-red-500 hover:text-red-500 hover:bg-red-50 transition-all dark:border-white/10 dark:hover:bg-red-500/5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-10 py-16 text-center text-slate-400 italic">Belum ada portofolio yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('components.modal-portofolio')

</div>

<script>
    function portofolioManager() {
        return {
            openModal: false,
            editMode: false,
            actionUrl: '',
            imageUrl: '',
            formData: { judul: '', deskripsi: '', url: '', status: '1' },

            openTambah() {
                this.editMode = false;
                this.formData = { judul: '', deskripsi: '', url: '', status: '1' };
                this.imageUrl = '';
                this.actionUrl = '{{ route("portofolio.store") }}';
                this.openModal = true;
            },

            openEdit(item) {
                this.editMode = true;
                this.formData = { 
                    judul: item.judul, 
                    deskripsi: item.deskripsi, 
                    url: item.url, 
                    status: item.status 
                };
                this.imageUrl = item.gambar ? '/storage/' + item.gambar : '';
                this.actionUrl = `/management/portofolio/${item.id}`; 
                this.openModal = true;
            },

            confirmDeletePorto(e) {
                const form = e.target.closest('form');
                Swal.fire({
                    title: 'Hapus Portofolio?',
                    text: "Data ini akan dihapus secara permanen dari sistem.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f97316',
                    cancelButtonColor: '#334155',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-[2rem] dark:bg-[#1e293b] dark:text-white',
                    }
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            }
        }
    }
</script>
@endsection