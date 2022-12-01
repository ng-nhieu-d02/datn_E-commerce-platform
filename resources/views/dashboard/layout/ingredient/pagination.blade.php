@if ($paginator->lastPage() > 1)
<div class="my-3 flex items-center justify-end space-x-1">
    <a href="{{ $paginator->url(1) }}" class="{{ ($paginator->currentPage() == 1) ? ' hidden' : '' }} flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
        </svg>
    </a>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    <a href="{{ $paginator->url($i) }}" class="{{ ($paginator->currentPage() == $i) ? 'bg-blue-400 text-gray-700' : 'bg-gray-300 text-gray-600' }} px-4 py-2  rounded-md hover:bg-blue-400 hover:text-white">
    {{ $i }}
    </a>
    @endfor
    <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' hidden' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
    </a>
</div>
@endif