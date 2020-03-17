<div class="flex flex-col">

    <div class="min-h-screen">
        <div class="flex justify-around h-full">
            <div class="p-4">
                <h1 class="text-gray-700 text-center font-bold tracking-wider text-4xl my-3">
                    {{ config('app.name', 'Laravel') }}
                </h1>

                <div class="mt-4 text-center">
                    <a class="text-blue-900 text-xs" target="_blank" href="https://github.com/richardkeep/covid-19">View Source Code</a>
                </div>

                 <div class="mt-4 flex flex-row justify-between text-sm items-center" style="background-color: #fff0fd;">
                    <div class="m-2">Cases: <span class="font-bold">{{ number_format($summary['cases']) }}</span></div>
                    <div class="m-2">Deaths: <span class="text-red-700 font-bold">{{ number_format($summary['deaths']) }}</span></div>
                    <div class="m-2">Recovered: <span class="text-green-700">{{ number_format($summary['recovered']) }}</span></div>
                </div>

                <div class="mt-4">
                    <input wire:model="search" type="text" placeholder="Search Country" class="p-2 w-full outline-none mt-2 border-2 rounded-full">
                    @if($search && ! count($countries))
                        <div class="my-4 text-gray-700">No search results found</div>
                    @endif
                </div>
                <div class="mt-4">
                    @foreach($countries as $country)
                        <div class="p-4 mb-8 rounded-lg" style="background-color: #f7efef;">
                            <div class="tracking-wide text-blue-700 font-bold text-xl font-normal">{{ $country->country }}</div>
                            <div class="flex flex-row justify-between mt-3">
                                <div class="flex flex-col">
                                    <div class="mb-3">
                                        <span class="text-gray-700">Cases: </span>
                                        <span class="font-bold">{{ number_format($country->cases) }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-gray-700">Deaths: </span>
                                        <span class="text-red-600 font-bold">{{ number_format($country->deaths) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="text-gray-700">Recovered: </span>
                                        <span class="text-green-700 font-bold">{{ number_format($country->recovered) }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="mb-3">
                                        <span class="text-gray-700">Today Cases: </span>
                                        <span class="font-bold">{{ number_format($country->todayCases) }}</span></div>
                                    <div class="mb-3">
                                        <span class="text-gray-700">Today Deaths: </span>
                                        <span class="text-red-700 font-bold">{{ number_format($country->todayDeaths) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="text-gray-700">Critical: </span>
                                        <span class="text-red-400">{{ number_format($country->critical) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>
