<div class="{{ isset($last) ? '' : 'mr-4' }} h-16 md:h-20 flex flex-col justify-between items-center flex-shrink-0 p-2 pt-4 bg-gray-200 hover:bg-gray-300 rounded-md border border-gray-400">
    <span class="text-base tracking-wide md:text-2xl font-bold {{ isset($danger) ? 'text-red-700' : 'text-gray-700' }}">{{ $data }}</span>
    <span class="text-xs text-gray-500 uppercase">{{ $title }}</span>
</div>
