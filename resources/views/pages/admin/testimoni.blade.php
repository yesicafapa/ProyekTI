@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>

<div class="mx-auto max-w-screen-2xl p-4 md:p-6" 
     x-data="{ 
        openModal: false, 
        editMode: false,
        actionUrl: '',
        imageUrl: '',
        formData: { pengguna: '', deskripsi: '', status: '1' },
        
        openTambah() {
            this.editMode = false;
            this.formData = { pengguna: '', deskripsi: '', status: '1' };
            this.imageUrl = '';
            this.actionUrl = '{{ route('testimoni.store') }}';
            this.openModal = true;
        },
        
        openEdit(item) {
            this.editMode = true;
            this.formData = { 
                pengguna: item.pengguna, 
                deskripsi: item.deskripsi, 
                status: item.status.toString() // Pastikan string untuk select
            };
            this.imageUrl = item.image_pengguna ? '/storage/' + item.image_pengguna : '';
            this.actionUrl = `/management/testimoni/${item.id}`; 
            this.openModal = true;
        }
     }" x-cloak>

    {{-- Notifikasi --}}
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
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4" /></svg>
            Tambah Testimoni
        </button>
    </div>

    {{-- Tabel Utama --}}
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-[#111827]">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200 dark:bg-slate-800/30 dark:border-slate-800">
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-slate-400">Info Pengguna</th>
                    <th class="px-8 py-5 text-center text-xs font-bold uppercase tracking-widest text-slate-400">Status</th>
                    <th class="px-8 py-5 text-right text-xs font-bold uppercase tracking-widest text-slate-400">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($testimonis as $item)
                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-all">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-5">
                            <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-full border border-slate-200 shadow-sm dark:border-slate-700">
                                @if($item->image_pengguna)
                                    <img src="{{ asset('storage/'.$item->image_pengguna) }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-orange-100 text-orange-500 font-black text-xl">
                                        {{ substr($item->pengguna, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="text-base font-bold text-slate-800 dark:text-slate-100 group-hover:text-orange-500 transition-colors">{{ $item->pengguna }}</div>
                                <div class="mt-1 text-xs font-medium text-slate-400 line-clamp-1 italic">
                                    "{{ $item->deskripsi }}"
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="inline-flex rounded-full px-3 py-1 text-[10px] font-bold border {{ $item->status == 1 ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-slate-50 text-slate-500 border-slate-200' }}">
                            {{ $item->status == 1 ? 'PUBLISHED' : 'DRAFT' }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <button @click="openEdit({{ $item }})" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-orange-500 hover:text-orange-500 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>
                            <form action="{{ route('testimoni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni dari {{ $item->pengguna }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-red-500 hover:text-red-500 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-10 text-center text-slate-400 italic">Belum ada data testimoni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PEMANGGILAN MODAL --}}
    @include('components.modal-testimoni')

</div>
@endsection