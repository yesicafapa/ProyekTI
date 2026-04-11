<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
  <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800 text-red-500">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
        <polyline points="22,6 12,13 2,6"></polyline>
    </svg>
  </div>

  <div class="flex items-end justify-between mt-5">
    <div>
      <span class="text-sm text-gray-500 dark:text-gray-400">Belum Direspon</span>
      <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
        {{-- Kita hitung yang is_responded bernilai false atau 0 --}}
        {{ \App\Models\Contact::where('is_responded', false)->count() }}
      </h4>
    </div>
  </div>
</div>