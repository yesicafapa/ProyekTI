<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
  <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800 text-purple-500">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
    </svg>
  </div>

  <div class="flex items-end justify-between mt-5">
    <div>
      <span class="text-sm text-gray-500 dark:text-gray-400">Total Testimoni</span>
      <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
        {{-- Memanggil model Testimoni yang baru kamu buat --}}
        {{ \App\Models\Testimoni::count() }}
      </h4>
    </div>
  </div>
</div>