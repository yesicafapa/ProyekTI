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
    
    /* Memastikan z-index SweetAlert tetap berada di lapisan paling atas */
    .swal2-container { z-index: 99999 !important; }
</style>

<div class="mx-auto max-w-screen-2xl p-4 md:p-6" x-cloak>
    
    {{-- Page Header --}}
    <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">Pesan Masuk</h1>
            <p class="text-slate-500 dark:text-slate-400 font-medium mt-1">Kelola diskusi proyek dari pengunjung website CV SEOVDETECH</p>
        </div>
    </div>

    {{-- Tabel Utama --}}
    <div class="overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm transition-colors duration-300 dark:border-white/5 dark:bg-[#0f1115] dark:shadow-2xl">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full min-w-[1000px] text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 dark:bg-white/[0.02] dark:border-white/5">
                        <th class="px-10 py-7 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">PENGIRIM</th>
                        <th class="px-10 py-7 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">KONTAK & LOKASI</th>
                        <th class="px-10 py-7 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">PESAN PROYEK</th>
                        <th class="px-10 py-7 text-center text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">STATUS</th>
                        <th class="px-10 py-7 text-right text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/[0.03]">
                    @forelse($messages as $item)
                    <tr class="group hover:bg-slate-50/50 transition-all duration-300 dark:hover:bg-white/[0.01]">
                        <td class="px-10 py-6">
                            <div class="flex flex-col gap-1">
                                <div class="text-[15px] font-bold text-slate-800 leading-tight transition-colors group-hover:text-orange-500 dark:text-white">
                                    {{ $item->nama }}
                                </div>
                                <div class="text-xs font-medium text-slate-400">{{ $item->email }}</div>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <div class="flex flex-col gap-1">
                                <span class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ $item->telepon }}</span>
                                <span class="text-[10px] text-slate-400 uppercase font-black tracking-wider">{{ $item->alamat }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <div class="text-[13px] text-slate-500 dark:text-slate-400 italic line-clamp-2 max-w-xs leading-relaxed">
                                "{{ $item->pesan }}"
                            </div>
                        </td>
                        <td class="px-10 py-6 text-center">
                            @if($item->is_responded)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-4 py-1.5 text-[10px] font-black tracking-widest text-emerald-600 border border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20">
                                    SELESAI
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-50 px-4 py-1.5 text-[10px] font-black tracking-widest text-orange-600 border border-orange-100 dark:bg-orange-500/10 dark:text-orange-400 dark:border-orange-500/20">
                                    <span class="h-1.5 w-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                                    PERLU RESPON
                                </span>
                            @endif
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex items-center justify-end gap-3">
                                {{-- LOGIKA MEMBERSIHKAN NOMOR WA --}}
                                @php
                                    $nomorWa = preg_replace('/[^0-9]/', '', $item->telepon);
                                    if (str_starts_with($nomorWa, '0')) {
                                        $nomorWa = '62' . substr($nomorWa, 1);
                                    }
                                @endphp

                                {{-- LINK WA --}}
                                <a href="https://api.whatsapp.com/send?phone={{ $nomorWa }}" 
                                   target="_blank" 
                                   class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20 hover:scale-110 active:scale-95 transition-all"
                                   title="Hubungi via WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </a>

                                {{-- TOMBOL UPDATE STATUS --}}
                                @if(!$item->is_responded)
                                <form action="{{ route('contact.updateStatus', $item->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="button" @click="confirmDone($event, '{{ $item->nama }}')" 
                                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 transition-all dark:border-white/10 dark:hover:bg-orange-500/5" 
                                            title="Tandai Sudah Dibalas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>
                                @endif

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('contact.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" @click="confirmDeleteMsg($event, '{{ $item->nama }}')" 
                                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-red-500 hover:text-red-500 hover:bg-red-50 transition-all dark:border-white/10 dark:hover:bg-red-500/5" 
                                            title="Hapus Pesan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-20 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-300 dark:text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 opacity-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 4-8-4" />
                                </svg>
                                <span class="text-xs font-black uppercase tracking-[0.3em]">Kotak Masuk Kosong</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    /**
     * Konfirmasi Selesai/Sudah Dibalas
     */
    function confirmDone(e, sender) {
        const form = e.target.closest('form');
        Swal.fire({
            title: 'Tandai Selesai?',
            text: `Apakah Anda sudah membalas pesan dari ${sender}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f97316',
            cancelButtonColor: '#334155',
            confirmButtonText: 'Ya, Sudah!',
            cancelButtonText: 'Belum',
            reverseButtons: true,
            customClass: { 
                popup: 'rounded-[2rem] dark:bg-[#1e293b] dark:text-white',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    }

    /**
     * Konfirmasi Hapus Pesan
     */
    function confirmDeleteMsg(e, sender) {
        const form = e.target.closest('form');
        Swal.fire({
            title: 'Hapus Pesan?',
            text: `Pesan dari ${sender} akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#334155',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: { 
                popup: 'rounded-[2rem] dark:bg-[#1e293b] dark:text-white',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    }
</script>
@endsection