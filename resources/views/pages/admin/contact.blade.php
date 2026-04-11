@extends('layouts.app') 

@section('content')
<div class="p-6 sm:p-10">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-slate-800 dark:text-white">Pesan Masuk</h1>
            <p class="text-sm font-medium text-slate-400">Kelola diskusi proyek dari pengunjung website.</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl dark:border-slate-800 dark:bg-[#1a2233]">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Pengirim</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Kontak & Alamat</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Pesan Proyek</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($messages as $item)
                <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="font-bold text-slate-800 dark:text-white">{{ $item->nama }}</div>
                        <div class="text-xs text-slate-400">{{ $item->email }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ $item->telepon }}</span>
                            <span class="text-[10px] text-slate-400 uppercase font-medium">{{ $item->alamat }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 max-w-xs italic">
                            "{{ $item->pesan }}"
                        </p>
                    </td>
                    <td class="px-8 py-6">
                        @if($item->is_responded)
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-emerald-600 dark:bg-emerald-500/10">
                                Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-orange-600 dark:bg-orange-500/10">
                                Perlu Respon
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            {{-- Tombol Hubungi via WA --}}
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->telepon) }}" target="_blank" 
                               class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20 hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </a>

                            {{-- Tombol Toggle Status --}}
                            <form action="{{ route('contact.updateStatus', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-orange-500 hover:text-white transition-all dark:bg-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('contact.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-400 hover:bg-red-500 hover:text-white transition-all dark:bg-slate-800">
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
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 opacity-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 4-8-4" />
                            </svg>
                            <span class="text-sm font-bold uppercase tracking-widest">Belum ada pesan masuk</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection