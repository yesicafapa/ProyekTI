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
        formData: { nama: '', email: '', level: 'admin', password: '' },
        
        openTambah() {
            this.editMode = false;
            this.formData = { nama: '', email: '', level: 'admin', password: '' };
            this.imageUrl = '';
            this.actionUrl = '{{ route('user-management.store') }}';
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
        }
     }" x-cloak>

    {{-- Page Header --}}
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">User Management</h2>
            <p class="text-slate-500 dark:text-slate-400 font-medium mt-1">Kelola hak akses dan akun administrator CV SEOVDETECH</p>
        </div>
        <button @click="openTambah()" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-8 py-4 text-center font-bold text-white shadow-xl shadow-orange-500/30 hover:bg-orange-600 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4" /></svg>
            Tambah Admin
        </button>
    </div>

    {{-- Tabel Utama --}}
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-[#111827]">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200 dark:bg-slate-800/30 dark:border-slate-800">
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-slate-400">Profil Admin</th>
                    <th class="px-8 py-5 text-center text-xs font-bold uppercase tracking-widest text-slate-400">Level Akses</th>
                    <th class="px-8 py-5 text-right text-xs font-bold uppercase tracking-widest text-slate-400">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($users as $item)
                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-all">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-5">
                            <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-2xl border border-slate-200 shadow-sm dark:border-slate-700">
                                @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-slate-100 text-slate-400 font-black text-xl dark:bg-slate-800">
                                        {{ substr($item->nama, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="text-base font-bold text-slate-800 dark:text-slate-100 group-hover:text-orange-500 transition-colors">{{ $item->nama }}</div>
                                <div class="mt-1 text-xs font-medium text-slate-400">{{ $item->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="inline-flex rounded-full px-3 py-1 text-[10px] font-bold border {{ $item->level == 'super admin' ? 'bg-orange-50 text-orange-600 border-orange-200' : 'bg-blue-50 text-blue-600 border-blue-200' }}">
                            {{ strtoupper($item->level) }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <button @click="openEdit({{ $item }})" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-orange-500 hover:text-orange-500 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>

                            {{-- Form Hapus dengan SweetAlert2 --}}
                            @if(auth()->id() !== $item->id)
                            <form id="delete-form-{{ $item->id }}" action="{{ route('user-management.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama }}')" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:border-red-500 hover:text-red-500 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-10 text-center text-slate-400 italic">Belum ada data admin.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('components.modal-user-management')

</div>

{{-- Data Bridge untuk Notifikasi --}}
<div id="flash-data" data-success="{{ session('success') }}" class="hidden"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, nama) {
        Swal.fire({
            title: 'Hapus Akses Admin?',
            html: `Anda akan menghapus akses untuk admin <b>${nama}</b>.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f97316', // Orange Seovdetech
            cancelButtonColor: '#334155',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#ffffff', // Ganti ke #111827 jika ingin dark mode full
            borderRadius: '24px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    document.addEventListener('DOMContentLoaded', function() {
        const successMsg = document.getElementById('flash-data').getAttribute('data-success');
        if (successMsg) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: successMsg,
                showConfirmButton: false,
                timer: 2000,
                borderRadius: '24px'
            });
        }
    });
</script>
@endsection