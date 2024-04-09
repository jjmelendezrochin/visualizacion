<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div style="padding-top: 20px; padding-left: 20px; padding-right: 20px">
        <div class="max-w-full mx-auto">
            <div class="bg-inherit dark:bg-gray-800 overflow-hidden  sm:rounded-lg">
                <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                    Lista de archivos:
                </h2>
                <br>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    @foreach ($archivos as $archivo)
                        <li class="flex items-center">
                            &#x2022; &NonBreakingSpace; <a
                                href="{{ URL::to('/') }}/uploads/{{ strtolower($archivo) }}"
                                target="_blank">
                                {{ strtolower($archivo) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-app-layout>
