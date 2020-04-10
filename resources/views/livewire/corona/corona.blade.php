<div class="mr-2 flex flex-col text-xs" wire:poll.60s>
    <div class="min-h-screen container mx-auto">
        <div class="flex justify-around h-full">
            <div class="min-w-full px-4 my-4">
                <div class="flex items-center">
                    <div class="w-full flex justify-between md:flex-row items-center h-8">
                        <div class="text-gray-700 uppercase font-bold tracking-wider text-base md:text-2xl">
                           <span>{{ config('app.name', 'Laravel') }}</span>
                        </div>

                        <div class="flex justify-center">
                            <select wire:model="lang" class="bg-gray-200 rounded-md hover:outline-none">
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                            </select>
                            <a target="_blank" href="https://twitter.com/richard_keep" class="ml-6 text-gray-600 hover:text-gray-800">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                            </a>
                            <a target="_blank" href="https://github.com/richardkeep/covid-19" class="ml-6 text-gray-600 hover:text-gray-800">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between md:grid grid-cols-6 min-w-full mt-4 overflow-scroll md:overflow-hidden">
                    <div class="mr-2 flex flex-col text-xs md:text-base flex-shrink-0 p-3 bg-gray-200 rounded-md border border-gray-600">
                        <span class="text-gray-700 font-extrabold uppercase">@lang('corona.today_cases')</span>
                        <span class="mt-1 font-bold text-gray-800">{{ number_format($summary['todayCases']) }}</span>
                    </div>
                    <div class="mr-2 flex flex-col text-xs md:text-base p-3 flex-shrink-0 bg-gray-200 rounded-md border border-gray-600">
                        <span class="text-gray-700 font-extrabold uppercase">@lang('corona.today_deaths')</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary['todayDeaths']) }}</span>
                    </div>
                    <div class="mr-2 flex flex-col text-xs md:text-base flex-shrink-0 p-3 bg-gray-200 rounded-md border border-gray-600">
                        <span class="text-gray-500 uppercase">@lang('corona.total_cases')</span>
                        <span class="mt-1 font-bold text-gray-900">{{ number_format($summary['cases']) }}</span>
                    </div>
                    <div class="mr-2 flex flex-col text-xs md:text-base flex-shrink-0 p-3 bg-gray-200 rounded-md border border-gray-600">
                        <span class="text-gray-500 uppercase">@lang('corona.total_deaths')</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary['deaths']) }}</span>
                    </div>
                    <div class="mr-2 flex flex-col text-xs md:text-base flex-shrink-0 p-3 bg-gray-200 rounded-md border border-gray-600">
                        <span class="text-gray-500 uppercase">@lang('corona.recovered')</span>
                        <span class="mt-1 text-green-500 font-bold">{{ number_format($summary['recovered']) }}</span>
                    </div>
                    <div class="flex flex-col text-xs md:text-base flex-shrink-0 p-3 bg-gray-200 rounded-md border border-gray-600">
                        <span class="text-gray-500 uppercase">@lang('corona.critical')</span>
                        <span class="mt-1 text-red-500 font-bold">{{ number_format($summary['critical']) }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center flex-col-reverse md:flex-row">

                    <div class="mt-4 w-full md:w-4/5 lg:w-1/3 flex items-center">
                        @if($search && ! count($countries))
                        <div class="my-4 text-gray-700">No search results found</div>
                        @else
                        <select wire:model="field" class="bg-gray-200 focus:bg-white focus:outline-none focus:shadow font-bold mr-3 mt-2 p-3 rounded-md text-gray-600 w-full">

                            <optgroup label="TODAY">
                                <option value="todayCases">@lang('corona.today_cases')</option>
                                <option value="todayDeaths">@lang('corona.today_deaths')</option>
                            </optgroup>
                            <optgroup label="TOTAL">
                                <option value="cases">@lang('corona.total_cases')</option>
                                <option value="deaths">@lang('corona.total_deaths')</option>
                                <option value="recovered">@lang('corona.recovered')</option>
                                <option value="critical">@lang('corona.critical')</option>
                            </optgroup>
                        </select>

                        <div class="cursor-pointer" >
                            @if($order == 'asc')
                           <svg wire:click.prevent="$set('order', 'desc')" class="h-4 w-4 fill-current text-gray-600" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M13,10 L13,2 L7,2 L7,10 L2,10 L10,18 L18,10 L13,10 Z" id="Combined-Shape"></path>
                            </svg>
                            @else
                            <svg wire:click.prevent="$set('order', 'asc')" class="h-4 w-4 fill-current text-gray-600" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <polygon id="Combined-Shape" points="7 10 7 18 13 18 13 10 18 10 10 2 2 10 7 10"></polygon>
                            </svg>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="w-full md:w-4/5 lg:w-1/3 pt-3">
                        <div class="flex justify-end">
                                 <div class="h-10 relative w-full max-w-3xl">
                                    <div class="absolute h-10 left-0 top-0 flex items-center pl-4">
                                        <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path></svg>
                                    </div>
                                    <input x-model="search" wire:model.debounce.1s="search" placeholder="{{ __('corona.search_country') }}" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-500 font-bold rounded-lg pl-12 pr-4 py-3">
                                    @if(strlen($search))
                                    <div class="absolute h-10 right-0 top-0 flex items-center pr-4">
                                        <svg wire:click.prevent="$set('search', '')" class="cursor-pointer h-4 w-4 fill-current text-gray-600" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                                <span class="mr-1 text-gray-500 font-bold text-base font-bold">{{ $loop->iteration }}.</span>
                                <span class="flex-1 font-bold text-blue-800 text-base tracking-wide">{{ $country['country'] }}</span>
                                <span class="text-lg">{{ $country['emoji'] }}</span>
                            </div>
                            <div class="mr-2 flex flex-row justify-between mt-3">
                                <div class="mr-2 flex flex-col text-xs">
                                    <div class="mb-2">
                                        <span class="text-xs text-gray-700">@lang('corona.total_cases'): </span>
                                        <span class="text-xs font-bold">{{ number_format($country['cases']) }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-xs text-gray-700">@lang('corona.total_deaths'): </span>
                                        <span class="text-xs text-red-600 font-bold">{{ number_format($country['deaths']) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="text-xs text-gray-700">@lang('corona.recovered'): </span>
                                        <span class="text-xs text-green-700 font-bold">{{ number_format($country['recovered']) }}</span>
                                    </div>
                                </div>
                                <div class="mr-2 flex flex-col text-xs">
                                    <div class="mb-2">
                                        <span class="text-xs text-gray-700">@lang('corona.today_cases'): </span>
                                        <span class="text-xs font-bold">{{ number_format($country['todayCases']) }}</span></div>
                                    <div class="mb-2">
                                        <span class="text-xs text-gray-700">@lang('corona.today_deaths'): </span>
                                        <span class="text-xs text-red-700 font-bold">{{ number_format($country['todayDeaths']) }}</span>
                                    </div>
                                    <div class="">
                                        <span class="text-xs text-gray-700">@lang('corona.critical'): </span>
                                        <span class="text-xs text-red-400">{{ number_format($country['critical']) }}</span>
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
