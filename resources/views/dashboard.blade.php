<head>
    <title>{{ __('Title') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<script>
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

<!-- Scripts -->
@vite(['resources/js/app.js'])

<script>
    // *********************************************
    // Valida que todos los datos tengan información
    function validadatos() {
        var nombre_archivo = $("#nombre_archivo").val();

        if (nombre_archivo == '') {
            toastr.error('Favor de capturar el nombre del archivo', 'Atención');
            return false;
        } else {
            return true;
        }

    }

    // ***********************
    // Ejecuta esta función sin la validaciós e exitosa
    // realiza la consulta
    function validayconsulta() {
        toastr.success('Consulta de datos ...', 'Procesando');
        $('#form1').submit();
    }
</script>



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div style="padding-top: 5px; padding-left: 10px; padding-right: 10px">
        <div class="max-w-full mx-auto">
            <div class="bg-inherit dark:bg-gray-800 overflow-hidden  sm:rounded-lg">
                <div class="flex flex-row p-1 text-gray-900 dark:text-gray-100 ">

                    <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Ver Carpetas"
                        onclick="window.location='/folders'">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </x-primary-button>
                    &NonBreakingSpace;
                    &NonBreakingSpace;
                    &NonBreakingSpace;
                    &NonBreakingSpace;
                    &NonBreakingSpace;
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Lista de archivos en carpeta {{ $datos[2] }}
                    </h2>


                </div>

                <form method="GET" action="{{ route('dashboard') }}" name="form1" id="form1">
                    @csrf
                    <input type="hidden" id="laruta" name="laruta" value="{{ $datos[2] }}">
                    <div class="flex flex-row p-6 text-gray-900 dark:text-gray-100 ">
                        <div>
                            <!-- ********************* -->
                            <!-- Búsqueda por número de inventario -->
                            <input type="text" id="nombre_archivo" name="nombre_archivo" size="70px"
                                width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->nombre_archivo)) value=""
                            @else
                                value="{{ $datos[1]->nombre_archivo }}" @endif
                                placeholder="{{ __('What file are you looking for?') }}" />
                        </div>
                        <!-- ********************* -->
                        <!-- botón de buscar -->
                        <div style="padding-left: .10in; padding-top: .10in" onclick="validayconsulta();">
                            <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Buscar datos"
                                onclick="return false;">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 23 23">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </x-primary-button>
                        </div>
                    </div>
                </form>
                <div
                    class="justify-content-center p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    {{ $datos[0]->withQueryString()->links() }}
                </div>
                <table
                    class="table table-bordered p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <tbody>
                        @foreach ($datos[0] as $ruta)
                            <tr>
                                <td>&#x2022; &NonBreakingSpace;
                                    <a href="javascript:window.open('{{ URL::to('/') }}/{{ strtolower($ruta->ruta) }}/{{ strtolower($ruta->archivo) }}' + '#toolbar=0', '_blank', 'height=600,width=800')">
                                        {{ $ruta->archivo }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="height: 0.5cm"></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <br>

        </div>
    </div>

</x-app-layout>
