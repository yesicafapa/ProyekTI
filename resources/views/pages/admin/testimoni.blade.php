@extends('layouts.app')

@section('content')
{{-- Load Google Font Poppins agar seragam dengan modul lainnya --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; }
    [x-cloak] { display: none !important; }
    
    /* Scrollbar halus untuk area tabel mobile */
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }
    
    /* Memastikan SweetAlert tampil di depan elemen dashboard */
    .swal2-container { z-index: 99999 !important; }
</style>

<div class="mx-auto max-w-screen-2xl p-4 md:p-6" 
     x-data="testimoniManager()" 
     x-cloak>

    {{-- Alert Berhasil --}}
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
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">Manajemen Testimoni</h2>
            <p class="text-slate-500 dark:text-slate-400 font-medium mt-1">Review dan feedback klien untuk CV SEOVDETECH</p>
        </div>
        <button @click="openTambah()" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-8 py-4 text-center font-bold text-white shadow-xl shadow-orange-500/30 hover:bg-orange-600 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path d="M12 4v16m8-8H4" />
            </svg>
            Tambah Testimoni
        </button>
    </div>

    {{-- Tabel Utama --}}
    <div class="overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm transition-colors duration-300 dark:border-white/5 dark:bg-[#0f1115] dark:shadow-2xl">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full min-w-[800px] text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 dark:bg-white/[0.02] dark:border-white/5">
                        <th class="px-10 py-7 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">INFO PENGGUNA</th>
                        <th class="px-10 py-7 text-center text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">STATUS</th>
                        <th class="px-10 py-7 text-right text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">OPSI KELOLA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/[0.03]">
                    @forelse($testimonis as $item)
                    <tr class="group hover:bg-slate-50/50 transition-all duration-300 dark:hover:bg-white/[0.01]">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-6">
                                {{-- Avatar / Profile Image --}}
                                <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-full border border-slate-200 shadow-sm dark:border-white/10 dark:shadow-lg bg-orange-50 dark:bg-orange-500/5">
                                    @if($item->image_pengguna)
                                        <img src="{{ asset('storage/'.$item->image_pengguna) }}" 
                                             class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-orange-500 font-black text-xl uppercase">
                                            {{ substr($item->pengguna, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                {{-- Detail --}}
                                <div class="flex flex-col gap-1">
                                    <div class="text-[15px] font-bold text-slate-800 leading-tight transition-colors group-hover:text-orange-500 dark:text-white">
                                        {{ $item->pengguna }}
                                    </div>
                                    <div class="text-[12px] font-medium text-slate-500 dark:text-slate-400 italic line-clamp-1 max-w-sm">
                                        "{{ $item->deskripsi }}"
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
                                
                                <form action="{{ route('testimoni.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" @click="confirmDeleteTesti($event, '{{ $item->pengguna }}')" 
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
                        <td colspan="3" class="px-10 py-16 text-center text-slate-400 italic font-medium">Belum ada data testimoni yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Component --}}
    @include('components.modal-testimoni')

</div>

<script>
    function testimoniManager() {
        return {
            openModal: false,
            editMode: false,
            actionUrl: '',
            imageUrl: '',
            formData: { pengguna: '', deskripsi: '', status: '1' },

            openTambah() {
                this.editMode = false;
                this.formData = { pengguna: '', deskripsi: '', status: '1' };
                this.imageUrl = '';
                this.actionUrl = '{{ route("testimoni.store") }}';
                this.openModal = true;
            },

            openEdit(item) {
                this.editMode = true;
                this.formData = { 
                    pengguna: item.pengguna, 
                    deskripsi: item.deskripsi, 
                    status: item.status.toString() 
                };
                this.imageUrl = item.image_pengguna ? '/storage/' + item.image_pengguna : '';
                this.actionUrl = `/management/testimoni/${item.id}`; 
                this.openModal = true;
            },

            confirmDeleteTesti(e, name) {
                const form = e.target.closest('form');
                const isDark = document.documentElement.classList.contains('dark');
                
                Swal.fire({
                    title: 'Hapus Testimoni?',
                    text: `Ulasan dari ${name} akan dihapus secara permanen dari sistem.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f97316', 
                    cancelButtonColor: isDark ? '#1a1a1a' : '#334155',
                    confirmButtonText: 'YA, HAPUS!',
                    cancelButtonText: 'BATAL',
                    reverseButtons: true,                    
                    background: isDark ? '#111111' : '#ffffff',
                    color: isDark ? '#ffffff' : '#475569',
                    
                    customClass: {
                        popup: 'rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl',
                        confirmButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest',
                        cancelButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (form) {
                            form.submit();
                        }
                    }
                });
            }
        }
    }
</script>
@endsection