<head>
    <title>Consulta de datos</title>

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
    // Exportación de datos
    function exporta() {        
        var numinv = $("#numinv").val();
        var descripcion = $("#descripcion").val();
        var area = $("#area").val();
        var edificio = $("#edificio").val();
        var piso = $("#piso").val();
        var empleado = $("#empleado").val();
        var serie = $("#serie").val();

        // Valida y consulta si hay datos
        if (validadatos())
        {
            toastr.warning('Preparando datos para exportar ...', 'Procesando');
            window.location = "/exportar?numinv=" + numinv +
            "&descripcion=" + descripcion +
            "&area=" + area +
            "&edificio=" + edificio +
            "&piso=" + piso +
            "&empleado=" + empleado +
            "&serie=" + serie;
        }

    }

    // *********************************************
    // Exportación de todos los datos
    function exporta1() {
        toastr.warning('Preparando datos para exportar ...', 'Procesando');
        window.open('http://172.19.11.54/Exportacion/Exporta.xlsx', "_blank");
    }

    // *********************************************
    // Valida que todos los datos tengan información
    function validadatos()
    {
        var numinv = $("#numinv").val();
        var descripcion = $("#descripcion").val();
        var area = $("#area").val();
        var edificio = $("#edificio").val();
        var piso = $("#piso").val();
        var empleado = $("#empleado").val();
        var serie = $("#serie").val();

        if (numinv      == ''
        && descripcion  == ''
        && area         == ''
        && edificio     == ''
        && piso         == ''
        && empleado     == ''
        && serie        == '')
        {
            toastr.error ('Favor de capturar todos los datos', 'Atención');
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
        if(validadatos()){
            toastr.success('Consulta de datos ...', 'Procesando');
            $('#form1').submit();
        }
    }

</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Querys') }}
        </h2>
    </x-slot>

    <div style="padding-top: 10px; padding-left: 10px; padding-right: 10px">
        <div class="max-w-full mx-auto">
            <div class="bg-inherit dark:bg-gray-800 overflow-hidden  sm:rounded-lg">
                <form method="POST" action="{{ route('querys.store') }}" name="form1" id="form1">
                    @csrf
                    <div class="flex flex-row p-6 text-gray-900 dark:text-gray-100 ">
                        <div>

                            <!-- ********************* -->
                            <!-- Búsqueda por número de inventario -->
                            <input type="text" id="numinv" name="numinv" size="30px" width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->numinv)) value=""
                            @else
                                value="{{ $datos[1]->numinv }}" @endif
                                placeholder="{{ __('What are you looking for?') }}" />

                            <!-- ********************* -->
                            <!-- Búsqueda por descripción -->
                            <input type="text" id="descripcion" name="descripcion" size="30px" width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->descripcion)) value=""
                            @else
                                value="{{ $datos[1]->descripcion }}" @endif
                                placeholder="{{ __('What description are you looking for?') }}" />

                            <!-- ********************* -->
                            <!-- Búsqueda por area -->
                            <input type="text" id="area" name="area" size="30px" width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->area)) value=""
                            @else
                                value="{{ $datos[1]->area }}" @endif
                                placeholder="{{ __('What area are you looking for?') }}" />


                            <!-- ********************* -->
                            <!-- Búsqueda por edificio -->
                            <input type="text" id="edificio" name="edificio" size="30px" width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->edificio)) value=""
                            @else
                                value="{{ $datos[1]->edificio }}" @endif
                                placeholder="{{ __('What building are you looking for?') }}" />

                            <!-- ********************* -->
                            <!-- Búsqueda por piso -->
                            <input type="text" id="piso" name="piso" size="30px" width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->piso)) value=""
                            @else
                                value="{{ $datos[1]->piso }}" @endif
                                placeholder="{{ __('What floor are you looking for?') }}" />

                            <!-- ********************* -->
                            <!-- Búsqueda por empleado -->
                            <input type="text" id="empleado" name="empleado" size="30px" width="30px"
                                onkeypress="return
                                        var keycode = e.keyCode || e.which;
                                        if (keycode == 13) {
                                            validayconsulta();
                                        }
                                        "
                                class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                @if (!isset($datos[1]->empleado)) value=""
                            @else
                                value="{{ $datos[1]->empleado }}" @endif
                                placeholder="{{ __('What employee are you looking for?') }}" />

                            <!-- ********************* -->
                            <!-- Búsqueda por serie -->
                            <input type="text" id="serie" name="serie" size="30px" width="30px"
                            onkeypress="return
                                    var keycode = e.keyCode || e.which;
                                    if (keycode == 13) {
                                        validayconsulta();
                                    }
                                    "
                            class="rounded-md border-gray-300   bg-inherit  transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            @if (!isset($datos[1]->serie))
                                value=""
                            @else
                                value="{{ $datos[1]->serie }}"
                            @endif
                            placeholder="{{ __('What serie are you looking for?') }}" />

                            <br>
                            <!-- ********************* -->
                            <!-- Registros encontrados -->
                            @if (isset($datos[2]))
                                <div class="relative">
                                    <label for="floating_outlined"
                                        class="text-sm">
                                        Registros encontrados: {{ $datos[2] }} &NonBreakingSpace;
                                        &NonBreakingSpace;&NonBreakingSpace;
                                        Ultima fecha de escaneo: {{ $datos[3] }}
                                    </label>
                                </div>
                            @endif
                        </div>
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
                <div class="max-w-full mx-auto sm:px-6" style="text-align: right; padding-top:-15px">
                    @if (isset($datos[2]))
                        <x-primary-button onclick="exporta();" data-toggle="tooltip" data-placement="bottom" title="Exportar consulta">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 23 23">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                                </path>
                            </svg>
                        </x-primary-button>
                        
                        <x-primary-button onclick="exporta1();" data-toggle="tooltip" data-placement="bottom" title="Exportar todos los datos">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 23 23">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M22 3H2v6h1v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9h1zM4 5h16v2H4zm15 15H5V9h14zm-6-10v5.17l2.59-2.58L17 14l-5 5l-5-5l1.41-1.42L11 15.17V10z">
                                </path>
                            </svg>
                        </x-primary-button>                        
                    @endif
                </div>
                <br>
                <div class="max-w-3xl mx-auto">
                    @if (isset($datos[0]))
                        <table class="max-w-3xl text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700  bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Número de inventario
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Descripción
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Área
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
                                    <th scope="col" class="px-6 py-3">
                                        Serie
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos[0] as $consulta)
                                    <tr class="bg-inherit border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->numinv }}
                                        </td>
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->descripcion }}
                                        </td>
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->area }}
                                        </td>
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->edificio }}
                                        </td>
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->piso }}
                                        </td>
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->empleado }}
                                        </td>
                                        <td class="px-2 py-2 text-xs">
                                            {{ $consulta->serie }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
