@extends('layouts.app')

@section('content')
{{-- Font & Style Global --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; }
    [x-cloak] { display: none !important; }
    
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }
    
    .swal2-container { z-index: 99999 !important; }
</style>

<div class="mx-auto max-w-screen-2xl p-4 md:p-6" x-data="userManager()" x-cloak>

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Kelola Pengguna</h2>
            <p class="text-slate-600 dark:text-slate-400 font-medium mt-1">Kelola hak akses dan akun administrator CV SEOVDETECH</p>
        </div>
        <button @click="openTambah()" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-8 py-4 text-center font-bold text-white shadow-xl shadow-orange-500/30 hover:bg-orange-600 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path d="M12 4v16m8-8H4" />
            </svg>
            Tambah Admin
        </button>
    </div>

    {{-- Card Tabel --}}
    <div class="overflow-hidden rounded-[2.5rem] border border-slate-300 bg-white shadow-sm transition-colors duration-300 dark:border-white/5 dark:bg-[#0f1115] dark:shadow-2xl">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full min-w-[900px] text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 border-b border-slate-200 dark:bg-white/[0.02] dark:border-white/5">
                        <th class="px-10 py-7 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400">PROFIL ADMIN</th>
                        <th class="px-10 py-7 text-center text-[11px] font-bold uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400">LEVEL AKSES</th>
                        <th class="px-10 py-7 text-center text-[11px] font-bold uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400">STATUS</th>
                        <th class="px-10 py-7 text-right text-[11px] font-bold uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400">OPSI KELOLA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/[0.03]">
                    @forelse($users as $item)
                    <tr class="group hover:bg-slate-50 transition-all duration-300 dark:hover:bg-white/[0.01]">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-5">
                                <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-2xl border-2 border-slate-200 shadow-sm dark:border-white/10">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/'.$item->foto) }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-slate-200 text-slate-600 font-black text-xl dark:bg-slate-800 dark:text-slate-500">
                                            {{ substr($item->nama, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-[15px] font-bold text-slate-900 leading-tight transition-colors group-hover:text-orange-500 dark:text-white">
                                        {{ $item->nama }}
                                        @if(auth()->id() === $item->id)
                                            <span class="ml-1 text-[10px] font-bold text-orange-700 bg-orange-100 px-2 py-0.5 rounded-md dark:bg-orange-500/10 dark:text-orange-400">(Anda)</span>
                                        @endif
                                    </div>
                                    <div class="text-[12px] font-semibold text-slate-500 mt-0.5 dark:text-slate-400">{{ $item->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-6 text-center">
                            @if($item->level == 'super admin')
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-4 py-1.5 text-[10px] font-black tracking-widest text-orange-800 border border-orange-200 dark:bg-orange-500/10 dark:text-orange-400 dark:border-orange-500/20">
                                    SUPER ADMIN
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-4 py-1.5 text-[10px] font-black tracking-widest text-blue-800 border border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20">
                                    ADMINISTRATOR
                                </span>
                            @endif
                        </td>
                        <td class="px-10 py-6 text-center">
                            @if($item->level !== 'super admin')
                                <div class="flex flex-col items-center gap-2">
                                    <button type="button" 
                                            @click="toggleUserStatus('{{ $item->id }}', {{ $item->status }})"
                                            class="group relative inline-flex h-7 w-14 flex-shrink-0 cursor-pointer items-center rounded-full transition-all duration-300 focus:outline-none {{ $item->status == 1 ? 'bg-orange-500 shadow-lg shadow-orange-500/40' : 'bg-slate-300 dark:bg-slate-700' }}">
                                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-md transition duration-300 ease-in-out {{ $item->status == 1 ? 'translate-x-8' : 'translate-x-1' }}"></span>
                                    </button>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $item->status == 1 ? 'text-orange-500' : 'text-slate-500' }}">
                                        {{ $item->status == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </div>
                            @else
                                <span class="text-[10px] font-bold text-slate-400 uppercase italic tracking-widest">Sistem Aktif</span>
                            @endif
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button @click="openEdit({{ json_encode($item) }})" 
                                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-400 text-slate-600 hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 transition-all dark:border-white/10 dark:text-slate-400 dark:hover:bg-orange-500/5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                @if(auth()->id() !== $item->id && $item->level !== 'super admin')
                                <form id="delete-form-{{ $item->id }}" action="{{ route('user-management.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama }}')" 
                                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-400 text-slate-600 hover:border-red-500 hover:text-red-500 hover:bg-red-50 transition-all dark:border-white/10 dark:text-slate-400 dark:hover:bg-red-500/5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-10 py-20 text-center text-slate-500 italic font-bold">Data admin belum tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('components.modal-user-management')

    <form id="status-toggle-form" method="POST" class="hidden">
        @csrf
        @method('PATCH')
    </form>
</div>

<div id="flash-data" data-success="{{ session('success') }}" class="hidden"></div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function userManager() {
        return {
            openModal: false,
            editMode: false,
            actionUrl: '',
            imageUrl: '',
            formData: { nama: '', email: '', level: 'admin', password: '' },

            openTambah() {
                this.editMode = false;
                this.formData = { nama: '', email: '', level: 'admin', password: '' };
                this.imageUrl = '';
                this.actionUrl = '{{ route("user-management.store") }}';
                this.openModal = true;
            },

            openEdit(item) {
                this.editMode = true;
                this.formData = { 
                    nama: item.nama, 
                    email: item.email, 
                    level: item.level,
                    password: '' 
                };
                this.imageUrl = item.foto ? '/storage/' + item.foto : '';
                this.actionUrl = `/management/user-management/${item.id}`; 
                this.openModal = true;
            },

            toggleUserStatus(id, currentStatus) {
                const isDark = document.documentElement.classList.contains('dark');
                const statusText = currentStatus == 1 ? 'MENONAKTIFKAN' : 'MENGAKTIFKAN';
                const statusColor = currentStatus == 1 ? '#ef4444' : '#f97316';
                
                Swal.fire({
                    title: 'UBAH AKSES AKUN?',
                    html: `Apakah Anda yakin ingin <b style="color: ${statusColor}">${statusText}</b> akses masuk untuk akun ini?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f97316',
                    cancelButtonColor: isDark ? '#1a1a15' : '#475569',
                    confirmButtonText: 'YA, UBAH STATUS',
                    cancelButtonText: 'BATALKAN',
                    reverseButtons: true,
                    background: isDark ? '#0f1115' : '#ffffff',
                    color: isDark ? '#ffffff' : '#1e293b',
                    customClass: {
                        popup: 'rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl',
                        title: 'font-extrabold tracking-tight pt-8',
                        confirmButton: 'rounded-xl px-8 py-3 font-black uppercase tracking-[0.15em] text-[11px] shadow-lg shadow-orange-500/20 mb-4',
                        cancelButton: 'rounded-xl px-8 py-3 font-black uppercase tracking-[0.15em] text-[11px] border border-slate-200 dark:border-white/5 mb-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('status-toggle-form');
                        form.action = `/management/user-management/${id}/toggle`;
                        form.submit();
                    }
                });
            }
        }
    }

    function confirmDelete(id, nama) {
        const isDark = document.documentElement.classList.contains('dark');

        Swal.fire({
            title: 'HAPUS AKSES ADMIN?',
            html: `Seluruh data akses untuk <b>${nama}</b> akan dihapus secara permanen.`,
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: isDark ? '#1a1a15' : '#475569',
            confirmButtonText: 'YA, HAPUS PERMANEN',
            cancelButtonText: 'BATALKAN',
            reverseButtons: true,
            background: isDark ? '#0f1115' : '#ffffff',
            color: isDark ? '#ffffff' : '#1e293b',
            customClass: {
                popup: 'rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl',
                title: 'font-extrabold tracking-tight pt-8',
                confirmButton: 'rounded-xl px-8 py-3 font-black uppercase tracking-[0.15em] text-[11px] shadow-lg shadow-red-500/20 mb-4',
                cancelButton: 'rounded-xl px-8 py-3 font-black uppercase tracking-[0.15em] text-[11px] border border-slate-200 dark:border-white/5 mb-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    document.addEventListener('DOMContentLoaded', function() {
        const isDark = document.documentElement.classList.contains('dark');
        const successMsg = document.getElementById('flash-data').getAttribute('data-success');
        
        if (successMsg) {
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: successMsg,
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                background: isDark ? '#0f1115' : '#ffffff',
                color: isDark ? '#ffffff' : '#1e293b',
                customClass: {
                    popup: 'rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl',
                    title: 'font-black tracking-[0.2em] text-emerald-500 text-sm pt-4'
                }
            });
        }
    });
</script>
@endsection