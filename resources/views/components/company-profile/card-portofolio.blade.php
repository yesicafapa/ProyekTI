<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
  <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800 text-orange-500">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
    </svg>
  </div>

  <div class="flex items-end justify-between mt-5">
    <div>
      <span class="text-sm text-gray-500 dark:text-gray-400">Total Portofolio</span>
      <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
        {{ \App\Models\Portofolio::count() }}
      </h4>
    </div>
  </div>
</div>