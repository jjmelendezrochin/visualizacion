<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Querys') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <div
                    class="flex flex-row block p-4 ps-10 text-sm text-white-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-white-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-white-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div>
                        <input type="text" id="simple-search" size="30px"
                            class="flex flex-row block p-4 ps-10 text-sm text-white-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-white-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-white-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{ __('What are you looking for?') }}" required />
                    </div>
                    <div style="padding-left: .10in; padding-top: .10in">

                        <x-primary-button>
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </x-primary-button>

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
