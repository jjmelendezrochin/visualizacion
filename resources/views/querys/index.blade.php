<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Querys') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('querys.store') }}">
                    @csrf
                    <div class="flex flex-row p-6 text-gray-900 dark:text-gray-100 ">
                        <div>
                            <input type="text"
                                id="numinv"
                                name="numinv"
                                size="30px"
                                width="30px"
                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                class="rounded-md border-gray-300  pt-4 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($data['services'][0]))
                                    value=""
                                @else
                                    value="{{ $data['services'][0] }}"
                                @endif
                                placeholder="{{ __('What are you looking for?') }}" required />
                        </div>
                        <div style="padding-left: .10in; padding-top: .10in">
                            <x-primary-button>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </x-primary-button>

                        </div>

                    </div>
                </form>

                @if (isset($data['services'][0]))
                <br>
                    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                        <table class="max-w-5xl text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Número de inventario
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Descripción
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Area
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edificio
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Piso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Empleado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data['services'][0] }}
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data['services'][1] }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data['services'][2] }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data['services'][3] }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data['services'][4] }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data['services'][5] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
