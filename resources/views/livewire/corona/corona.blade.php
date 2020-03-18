<div class="flex flex-col">
    <div class="min-h-screen container mx-auto">
        <div class="flex justify-around h-full">
            <div class="min-w-full px-2">
                <h1 class="text-gray-700 text-center font-bold tracking-wider text-4xl my-3">
                    {{ config('app.name', 'Laravel') }}
                </h1>

                <div class="mt-4 text-center">
                    <a class="text-blue-900 text-xs" target="_blank" href="https://github.com/richardkeep/covid-19">View Source Code</a>
                </div>
                <div class="flex justify-center mt-8">
                    <div class="xs:w-1/2 p-4 flex flex-row justify-between xs:text-sm md:text-xl items-center bg-gray-700 rounded-md">
                        <div class="m-2">
                            <span class="text-gray-200 uppercase">Cases:</span>
                            <span class="font-bold text-purple-300">{{ number_format($summary['cases']) }}</span>
                        </div>
                        <div class="m-2">
                            <span class="text-gray-200 uppercase">Deaths:</span>
                            <span class="text-red-400 font-bold">{{ number_format($summary['deaths']) }}</span>
                        </div>
                        <div class="m-2">
                            <span class="text-gray-200 uppercase">Recovered:</span>
                            <span class="text-green-700 font-bold">{{ number_format($summary['recovered']) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-center">
                    <input wire:model="search" type="text" placeholder="Search Country" class="p-4 w-full md:w-1/3 outline-none mt-2 border-2 rounded-full">
                </div>

                <div class="mt-4 flex justify-center">
                    @if($search && ! count($countries))
                    <div class="my-4 text-gray-700">No search results found</div>
                    @endif
                </div>

                <div class="w-full flex justify-center flex-wrap">
                    @foreach($countries as $country)
                        <div class="p-4 m-4 w-full md:w-1/2 lg:w-1/4 bg-gray-300 rounded-md"">
                            <div class="tracking-wide text-blue-700 font-bold text-xl font-normal">{{ $country->id }}. {{ $country->country }}</div>
                            <div class="flex flex-row justify-between mt-3">
                                <div class="flex flex-col">
                                    <div class="mb-3">
                                        <span class="md:text-sm text-gray-700">Cases: </span>
                                        <span class="md:text-sm font-bold">{{ number_format($country->cases) }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="md:text-sm text-gray-700">Deaths: </span>
                                        <span class="md:text-sm text-red-600 font-bold">{{ number_format($country->deaths) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="md:text-sm text-gray-700">Recovered: </span>
                                        <span class="md:text-sm text-green-700 font-bold">{{ number_format($country->recovered) }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="mb-3">
                                        <span class="md:text-sm text-gray-700">Today Cases: </span>
                                        <span class="md:text-sm font-bold">{{ number_format($country->todayCases) }}</span></div>
                                    <div class="mb-3">
                                        <span class="md:text-sm text-gray-700">Today Deaths: </span>
                                        <span class="md:text-sm text-red-700 font-bold">{{ number_format($country->todayDeaths) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="md:text-sm text-gray-700">Critical: </span>
                                        <span class="md:text-sm text-red-400">{{ number_format($country->critical) }}</span>
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
