<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>{{ __('Title') }} </title>
</head>

<script>
    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
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
    
    // ***********************
    // Realiza la consulta
    // Manda un mensaje de error si el usuario no escribió nada
    // Hace la validación y consulta hasta que el usuario escriba el nombre de una carpeta
    function validayconsulta() {
        var nombre_archivo = $("#nombre_archivo").val();

        if (nombre_archivo == '') {
            toastr.error('Favor de capturar el nombre de una carpeta', 'Atención');
            $('#form1').submit();
            return false;
        } else {
            toastr.success('Consulta de datos ...', 'Procesando');
            $('#form1').submit();
            return true;
        }
    }

    // ***********************
    // Simplifica la ruta de una carpeta
    function rutaSimple(rutaraiz, ruta) {
        var rutacompleta = rutaraiz + '?ruta=' + ruta;
        window.location = rutacompleta;
    }
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Folders') }}
        </h2>
    </x-slot>

    <div style="padding-top: 10px; padding-left: 20px; padding-right: 20px">
        <div class="max-w-full mx-auto">
            <div class="bg-inherit dark:bg-gray-800 overflow-hidden  sm:rounded-lg">

                <div class="flex flex-row p-1 text-gray-900 dark:text-gray-100 ">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Lista de carpetas
                    </h2>
                </div>

                <form method="GET" action="{{ route('store') }}" name="form1" id="form1">
                    @csrf
                    <div class="flex flex-row p-6 text-gray-900 dark:text-gray-100 ">
                        <div>
                            <!-- ********************* -->
                            <!-- Búsqueda por número de inventario -->
                            <input type="text" id="nombre_archivo" name="nombre_archivo" size="70px" width="30px" onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        " class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" @if (!isset($datos[2])) value="" @else value="{{ $datos[2] }}" @endif placeholder="{{ __('What folder are you looking for?') }}" />
                        </div>
                        <!-- ********************* -->
                        <!-- botón de buscar -->
                        <!-- Cambie la función de validayconsulta() por validadatos() -->
                        <div style="padding-left: .10in; padding-top: .02in" onclick="validayconsulta();">
                            <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Buscar datos" onclick="return false;">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 23 23">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </x-primary-button>

                        </div>
                    </div>
                </form>

                <div class="p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    @foreach ($datos[0] as $ruta)
                    <div style="position: relative;">
                        <div style="display:inline-block;">
                            &#x2022;
                        </div>
                        <div style="display:inline-block;">
                            <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Mostrar carpeta" onclick="javascript:rutaSimple('{{URL::to('/dashboard')}}','{{$ruta->archivo}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                </svg>

                            </x-primary-button>
                        </div>
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        <div style="display:inline-block;">
                            <a href="{{URL::to('/dashboard')}}?ruta={{$ruta->archivo}}">
                                {{ $ruta->archivo }}
                            </a>
                        </div>
                    </div>
                    &NonBreakingSpace;
                    &NonBreakingSpace;
                    @endforeach

                </div>

                <!-- <table class="table table-bordered p-2 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <tbody class="p-6">
                        @foreach ($datos[0] as $ruta)
                        <tr>
                            <td>&#x2022; &NonBreakingSpace;
                                <a href="{{URL::to('/dashboard')}}?ruta={{$ruta->archivo}}">
                                    {{$ruta->archivo}}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td style="height: 0.5cm"></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    {{ $datos[0]->withQueryString()->links() }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
            <br>
        </div>
    </div>
</x-app-layout>