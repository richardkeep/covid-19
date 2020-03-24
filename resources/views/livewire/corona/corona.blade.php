<div class="flex flex-col">
    <div class="min-h-screen container mx-auto">
        <div class="flex justify-around h-full">
            <div class="min-w-full px-2">
                <h1 class="text-gray-700 uppercase text-center font-bold tracking-wider text-4xl my-3">
                    {{ config('app.name', 'Laravel') }}
                </h1>

                <div class="mt-4 text-center">
                    <a class="text-blue-900 text-xs" target="_blank" href="https://github.com/richardkeep/covid-19">View Source Code</a>
                </div>
                <div class="hidden md:grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 mt-3">
                    <div class="flex flex-col bg-gray-500 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-700 tracking-wide uppercase">Today Cases</span>
                        <span class="mt-1 font-bold text-gray-800">{{ number_format($summary->todayCases) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-500 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-700 tracking-wide uppercase">Today Deaths</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary->todayDeaths) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-300 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Total Cases</span>
                        <span class="mt-1 font-bold text-gray-900">{{ number_format($summary->cases) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-300 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Total Deaths</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary->deaths) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-300 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Recovered</span>
                        <span class="mt-1 text-green-500 font-bold">{{ number_format($summary->recovered) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-300 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Critical</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary->critical) }}</span>
                    </div>
                </div>

                <div class="flex justify-between flex-col md:flex-row">

                    <div class="mt-4 md:w-4/5 lg:w-1/3 flex items-center">
                        @if($search && ! count($countries))
                        <div class="my-4 text-gray-700">No search results found</div>
                        @else
                        <select wire:model="field" class="p-3 mr-3 w-full focus:outline-none focus:bg-white focus:shadow mt-2 text-purple-600 rounded-md">

                            <optgroup label="TODAY">
                                <option value="todayCases">Today Cases</option>
                                <option value="todayDeaths">Today Deaths</option>
                            </optgroup>
                            <optgroup label="TOTAL">
                                <option value="cases">Total Cases</option>
                                <option value="deaths">Total Deaths</option>
                                <option value="recovered">Recovered</option>
                                <option value="critical">Critical</option>
                            </optgroup>
                        </select>

                        <div class="cursor-pointer" wire:click="$emit('toggleDirection')">
                            @if($direction == 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M11 18.59V3a1 1 0 0 1 2 0v15.59l5.3-5.3a1 1 0 0 1 1.4 1.42l-7 7a1 1 0 0 1-1.4 0l-7-7a1 1 0 0 1 1.4-1.42l5.3 5.3z"/></svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M13 5.41V21a1 1 0 0 1-2 0V5.41l-5.3 5.3a1 1 0 1 1-1.4-1.42l7-7a1 1 0 0 1 1.4 0l7 7a1 1 0 1 1-1.4 1.42L13 5.4z"/></svg>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 md:w-4/5 lg:w-1/3 pt-3">
                        <div class="relative max-w-3xl mx-auto">
                            <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-4">
                                <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path></svg>
                            </div>
                            <input wire:model="search" type="search" placeholder="Search Country" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-500 font-bold rounded-lg pl-12 pr-4 py-3">
                        </div>
                    </div>
                </div>

                <div class="my-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($countries as $country)
                        <div class="p-4 w-full bg-gray-300 rounded-md"">
                            <div class="flex justify-between">
                                <span class="mr-1 text-gray-500 font-bold text-xl font-bold">{{ $country->id }}.</span>
                                <span class="flex-1 font-bold leading-5 text-blue-800 text-xl tracking-wide">{{ $country->country }}</span>
                                <span class="text-2xl">{{ $country->emoji }}</span>
                            </div>
                            <div class="flex flex-row justify-between mt-3">
                                <div class="flex flex-col">
                                    <div class="mb-2">
                                        <span class=md:text-sm text-gray-700">Cases: </span>
                                        <span class="md:text-sm font-bold">{{ number_format($country->cases) }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="md:text-sm text-gray-700">Deaths: </span>
                                        <span class="md:text-sm text-red-600 font-bold">{{ number_format($country->deaths) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="md:text-sm text-gray-700">Recovered: </span>
                                        <span class="md:text-sm text-green-700 font-bold">{{ number_format($country->recovered) }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="mb-2">
                                        <span class="md:text-sm text-gray-700">Today Cases: </span>
                                        <span class="md:text-sm font-bold">{{ number_format($country->todayCases) }}</span></div>
                                    <div class="mb-2">
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
