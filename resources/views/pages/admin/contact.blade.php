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

    /* Efek hover untuk teks pesan agar user tahu bisa diklik */
    .clickable-message:hover {
        color: #f97316; /* Orange-500 */
        text-decoration: underline;
        transition: all 0.3s ease;
    }
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
                            {{-- Click untuk Detail --}}
                            <div onclick="showDetail('{{ $item->nama }}', `{{ $item->pesan }}`)" 
                                 class="text-[13px] text-slate-500 dark:text-slate-400 italic line-clamp-2 max-w-xs leading-relaxed cursor-pointer clickable-message"
                                 title="Klik untuk lihat detail pesan">
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
                                @php
                                    // Logika Nomor WA & Pesan Otomatis Resmi
                                    $nomorWa = preg_replace('/[^0-9]/', '', $item->telepon);
                                    if (str_starts_with($nomorWa, '0')) {
                                        $nomorWa = '62' . substr($nomorWa, 1);
                                    }

                                    $templatePesan = "Halo *" . $item->nama . "*,\n\n" .
                                                     "Terima kasih telah menghubungi *CV SEOVDETECH*. Kami telah menerima pesan Anda mengenai:\n" .
                                                     "\"" . $item->pesan . "\"\n\n" .
                                                     "Admin kami akan segera membantu diskusi proyek Anda. Mohon tunggu sebentar ya!";
                                    
                                    $urlWa = "https://api.whatsapp.com/send?phone=" . $nomorWa . "&text=" . urlencode($templatePesan);
                                @endphp

                                {{-- FIX: Tombol WhatsApp dengan Ikon Resmi, Pas, dan Bulat Sempurna --}}
                                <a href="{{ $urlWa }}" 
                                   target="_blank" 
                                   class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20 hover:scale-110 active:scale-95 transition-all"
                                   title="Hubungi via WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.455 5.703 1.456h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </a>

                                @if(!$item->is_responded)
                                <form action="{{ route('contact.updateStatus', $item->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="button" onclick="confirmDone(event, '{{ $item->nama }}')" 
                                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 transition-all dark:border-white/10 dark:hover:bg-orange-500/5" 
                                            title="Tandai Sudah Dibalas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('contact.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDeleteMsg(event, '{{ $item->nama }}')" 
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
     * Tampilkan Detail Pesan Lengkap
     */
    function showDetail(sender, message) {
        const isDark = document.documentElement.classList.contains('dark');
        
        Swal.fire({
            title: `Detail Pesan: ${sender}`,
            html: `
                <div class="text-center p-6 ${isDark ? 'bg-white/5' : 'bg-slate-100'} rounded-2xl border ${isDark ? 'border-white/10' : 'border-slate-200'} mt-4">
                    <p style="color: ${isDark ? '#cbd5e1' : '#1e293b'} !important;" class="font-medium leading-relaxed whitespace-pre-line text-[15px] text-center">
                        ${message}
                    </p>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'SELESAI MEMBACA',
            confirmButtonColor: '#f97316',
            background: isDark ? '#111111' : '#ffffff',
            color: isDark ? '#ffffff' : '#475569',
            customClass: { 
                popup: 'rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl',
                title: 'font-bold',
                confirmButton: 'rounded-xl px-10 py-3 font-extrabold uppercase tracking-widest text-xs',
            }
        });
    }

    /**
     * Konfirmasi Selesai/Sudah Dibalas
     */
    function confirmDone(e, sender) {
        const form = e.target.closest('form');
        const isDark = document.documentElement.classList.contains('dark');
        
        Swal.fire({
            title: 'Tandai Selesai?',
            text: `Apakah Anda sudah membalas pesan dari ${sender}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f97316',
            cancelButtonColor: isDark ? '#1a1a1a' : '#334155',
            confirmButtonText: 'YA, SUDAH!',
            cancelButtonText: 'BELUM',
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
                if (form) form.submit();
            }
        });
    }

    /**
     * Konfirmasi Hapus Pesan
     */
    function confirmDeleteMsg(e, sender) {
        const form = e.target.closest('form');
        const isDark = document.documentElement.classList.contains('dark');
        
        Swal.fire({
            title: 'Hapus Pesan?',
            text: `Pesan dari ${sender} akan dihapus secara permanen dari sistem.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', 
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
                if (form) form.submit();
            }
        });
    }
</script>
@endsection