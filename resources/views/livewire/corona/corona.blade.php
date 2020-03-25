<div class="flex flex-col">
    <div class="min-h-screen container mx-auto">
        <div class="flex justify-around h-full">
            <div class="min-w-full px-4 my-4">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col flex-1 md:flex-row items-center h-8">
                        <div class="text-gray-700 uppercase font-bold tracking-wider text-base md:text-2xl">
                           <span>{{ config('app.name', 'Laravel') }}</span>
                        </div>

                        <div class="text-center md:ml-2">
                            <a class="text-blue-700 text-xs" target="_blank" href="https://github.com/richardkeep/covid-19">
                                Source Code
                            </a>
                            <a class="ml-4 text-blue-700 text-xs" target="_blank" href="https://twitter.com/richard_keep/">
                                Developer
                            </a>
                        </div>
                    </div>

                    <div class="bg-white" wire:loading>
                        <img class="h-8" src="/images/loading.gif" alt="Loading">
                    </div>
                </div>
                <div class="hidden md:grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 mt-4">
                    <div class="flex flex-col p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-700 tracking-wide uppercase">Today Cases</span>
                        <span class="mt-1 font-bold text-gray-800">{{ number_format($summary->todayCases) }}</span>
                    </div>
                    <div class="flex flex-col p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-700 tracking-wide uppercase">Today Deaths</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary->todayDeaths) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-200 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Total Cases</span>
                        <span class="mt-1 font-bold text-gray-900">{{ number_format($summary->cases) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-200 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Total Deaths</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary->deaths) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-200 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Recovered</span>
                        <span class="mt-1 text-green-500 font-bold">{{ number_format($summary->recovered) }}</span>
                    </div>
                    <div class="flex flex-col bg-gray-200 p-3 rounded-md shadow-md border border-gray-400">
                        <span class="text-gray-500 tracking-wide uppercase">Critical</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary->critical) }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center flex-col-reverse md:flex-row">

                    <div class="mt-4 w-full md:w-4/5 lg:w-1/3 flex items-center">
                        @if($search && ! count($countries))
                        <div class="my-4 text-gray-700">No search results found</div>
                        @else
                        <select wire:model="field" class="bg-gray-200 focus:bg-white focus:outline-none focus:shadow font-bold mr-3 mt-2 p-3 rounded-md text-gray-600 w-full">

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
                           <svg class="h-4 w-4 fill-current text-gray-600" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M13,10 L13,2 L7,2 L7,10 L2,10 L10,18 L18,10 L13,10 Z" id="Combined-Shape"></path>
                            </svg>
                            @else
                            <svg class="h-4 w-4 fill-current text-gray-600" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <polygon id="Combined-Shape" points="7 10 7 18 13 18 13 10 18 10 10 2 2 10 7 10"></polygon>
                            </svg>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="w-full md:w-4/5 lg:w-1/3 pt-3">
                        <div x-data="{ open: false }" class="flex justify-end">

                                <svg @click="open = true" x-show="!open" class="h-10 w-4 cursor-pointer fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path></svg>

                                 <div class="h-10 relative w-full max-w-3xl" x-show="open" @click.away="open = false">
                                    <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-4">
                                        <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path></svg>
                                    </div>
                                    <input wire:model="search" placeholder="Search Country" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-500 font-bold rounded-lg pl-12 pr-4 py-3">
                                    @if(strlen($search))
                                    <div class="absolute h-10 mt-1 right-0 top-0 flex items-center pr-4">
                                        <svg wire:click="clearSearch" class="cursor-pointer h-4 w-4 fill-current text-gray-600" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <polygon points="10 8.58578644 2.92893219 1.51471863 1.51471863 2.92893219 8.58578644 10 1.51471863 17.0710678 2.92893219 18.4852814 10 11.4142136 17.0710678 18.4852814 18.4852814 17.0710678 11.4142136 10 18.4852814 2.92893219 17.0710678 1.51471863 10 8.58578644"></polygon>
                                        </svg>
                                    </div>
                                    @endif
                                </div>

                        </div>

                    </div>
                </div>

                <div class="my-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($countries as $country)
                        <div class="p-4 w-full bg-gray-300 rounded-md hover:bg-blue-200 hover:shadow-lg">
                            <div class="flex justify-between">
                                <span class="mr-1 text-gray-500 font-bold text-xl font-bold">{{ $loop->iteration }}.</span>
                                <span class="flex-1 font-bold leading-5 text-blue-800 text-xl tracking-wide">{{ $country->country }}</span>
                                <span class="text-2xl">{{ $country->emoji }}</span>
                            </div>
                            <div class="flex flex-row justify-between mt-3">
                                <div class="flex flex-col">
                                    <div class="mb-2">
                                        <span class="md:text-sm text-gray-700">Cases: </span>
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
