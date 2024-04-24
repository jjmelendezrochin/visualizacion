<head>
    <title>{{ __('Title') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    // Hace la validación y consulta hasta que el usuario escriba el nombre de un archivo
    function validayconsulta() {
        var nombre_archivo = $("#nombre_archivo").val();

        if (nombre_archivo == '') {
            toastr.error('Favor de capturar el nombre de un archivo', 'Atención');
            $('#form1').submit();
            return false;
        } else {
            toastr.success('Consulta de datos ...', 'Procesando');
            $('#form1').submit();
            return true;
        }
        
    }

    // ***********************
    // Este script abre una ventana de la ruta del archivo
    // Deshabilita el menú cuando das clic derecho
    function bloqClicDer(rutaraiz, ruta, archivo) {
        var rutacompleta = rutaraiz + '/' + ruta + '/' + archivo;
        var openpopup = window.open(rutacompleta + '#toolbar=0', '_blank', 'height=600,width=800');
        openpopup.oncontextmenu = function() {
            return false;
        }
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

                    <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Ver Carpetas" onclick="window.location='/folders'">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
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
                            <input type="text" id="nombre_archivo" name="nombre_archivo" size="70px" width="30px" onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        " class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" @if (!isset($datos[1]->nombre_archivo)) value=""
                            @else
                            value="{{ $datos[1]->nombre_archivo }}"
                            @endif
                            placeholder="{{ __('What file are you looking for?') }}" />
                        </div>
                        <!-- ********************* -->
                        <!-- botón de buscar -->
                        <!-- Cambie la función de validayconsulta() por validadatos() -->
                        <div style="padding-left: .10in; padding-top: .02in; " onclick="validayconsulta();">
                            <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Buscar datos" onclick="return false;">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 23 23">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </x-primary-button>

                        </div>
                    </div>
                </form>
                <div class="justify-content-center p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    {{ $datos[0]->withQueryString()->links() }}
                </div>





                <!-- <table class="table table-bordered p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <tbody>
                        @foreach ($datos[0] as $ruta)
                        <tr>
                            <td>
                                &#x2022; &NonBreakingSpace;
                            </td>
                            <td>
                                <img src="{{ asset('/images/icono_pdf.png') }}" width="10%" height="10%">
                            </td>
                            <td align="left">
                                <a href="javascript:window.open('{{ URL::to('/') }}/{{ strtolower($ruta->ruta) }}/{{ strtolower($ruta->archivo) }}' + '#toolbar=0', '_blank', 'height=600,width=800')">
                                    {{ $ruta->archivo }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> -->
                <div class="p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    @foreach ($datos[0] as $ruta)
                    <div style="position: relative;">
                        <div style="display:inline-block;">
                            &#x2022;
                        </div>
                        <div style="display:inline-block;">
                            <x-primary-button data-toggle="tooltip" data-placement="bottom" title="Mostrar PDF" onclick="javascript:bloqClicDer('{{ URL::to('/') }}','{{$ruta->ruta}}','{{$ruta->archivo}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </x-primary-button>
                        </div>
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        <div style="display:inline-block;">
                            <a href="javascript:bloqClicDer('{{ URL::to('/') }}','{{$ruta->ruta}}','{{$ruta->archivo}}')">
                                {{ $ruta->archivo }}
                            </a>
                        </div>
                    </div>
                    &NonBreakingSpace;
                    &NonBreakingSpace;
                    @endforeach
                    
                </div>
                <!-- <div class="p-1 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    @foreach ($datos[0] as $ruta) -->
                <!-- Cambié la tabla que tenía anteriormente (está comentada arriba) por divs
                    Puse 2 divs dentro de un div principal para que el ícono y el nombre del PDF queden en la misma línea
                    Usé un align-items:center para que la viñeta, el ícono y el nombre del PDF esten centrados en la línea -->
                <!-- <div style="display: relative;">&#x2022;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        <div style="display:inline-block;">
                            <img src="{{ asset('/images/icono_pdf.png') }}" width="10%" height="10%">
                        </div> -->

                <!-- Buscar donde agregar un align-text:left para que queden juntos el ícono y el nombre del PDF -->
                <!-- <div style="display:inline-block;"> -->
                <!-- <a href="javascript:window.open('{{ URL::to('/') }}/{{ strtolower($ruta->ruta) }}/{{ strtolower($ruta->archivo) }}' + '#toolbar=0', '_blank', 'height=600,width=800')">
                                {{ $ruta->archivo }}
                            </a> -->

                <!-- <a href="javascript:bloqClicDer('{{ URL::to('/') }}','{{$ruta->ruta}}','{{$ruta->archivo}}')">
                                {{ $ruta->archivo }}
                            </a> -->

                <!-- Script que bloquea el clic derecho
                            Debe realizarse únicamente en la página que se abre cuando seleccionas un PDF para evitar que se pueda manipular o guardar
                            Obtenido de https://franyerverjel.com/blog/como-deshabilitar-el-click-derecho-de-una-web
                            <script type='text/javascript'>
                                document.oncontextmenu = function() {
                                    return false
                                }
                            </script> -->

                <!-- </div>
                    </div>
                    @endforeach
                </div> -->
            </div>

            <br>

        </div>
    </div>

</x-app-layout>