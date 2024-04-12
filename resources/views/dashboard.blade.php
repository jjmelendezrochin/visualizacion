<head>
    <title>{{ __('Title') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

	 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
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
    function validadatos()
    {
        var nombre_archivo = $("#nombre_archivo").val();

        if (nombre_archivo      == '')
        {
            toastr.error ('Favor de capturar el nombre del archivo', 'Atención');
            return false;
        }
        else{
            return true;
        }

    }

    // ***********************
    // Ejecuta esta función sin la validaciós e exitosa
    // realiza la consulta
    function validayconsulta()
    {
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


    <div style="padding-top: 20px; padding-left: 20px; padding-right: 20px">
        <div class="max-w-full mx-auto">
            <div class="bg-inherit dark:bg-gray-800 overflow-hidden  sm:rounded-lg">

                <div class="flex flex-row p-1 text-gray-900 dark:text-gray-100 ">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Lista de archivos en carpeta {{ $datos[2] }}
                    </h2>
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                    <x-primary-button data-toggle="tooltip"
                            data-placement="bottom" title="Ver Carpetas"
                        onclick="window.location='/folders'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                          </svg>

                          {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /> </svg> --}}

                    </x-primary-button>
                </div>

                <form method="GET" action="{{ route('dashboard') }}" name="form1" id="form1">
                    @csrf
                    <input type="hidden" id="laruta" name="laruta" value="{{$datos[2]}}">
                    <div class="flex flex-row p-6 text-gray-900 dark:text-gray-100 ">
                        <div>
                            <!-- ********************* -->
                            <!-- Búsqueda por número de inventario -->
                            <input
                                type="text"
                                id="nombre_archivo"
                                name="nombre_archivo"
                                size="70px"
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
                        <div style="padding-left: .10in; padding-top: .10in"
                            onclick="validayconsulta();">
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

                <table class="table table-bordered p-6 max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <tbody class="p-6">
                        @foreach ($datos[0] as $ruta)
                            <tr>
                                <td>&#x2022; &NonBreakingSpace;
                                    <a href="{{ URL::to('/') }}/{{ strtolower($ruta->ruta) }}/{{ strtolower($ruta->archivo) }}"
                                        target="_blank">
                                        {{ $ruta->archivo }}
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
                </table>
            </div>

            <br>

        </div>
    </div>

</x-app-layout>
