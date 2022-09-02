<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                Lista de clientes
            </h2>
            <a href="{{ route('clients.create') }}"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none
                 focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5  cursor-pointer
                  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Nuevo Cliente
            </a>
        </div>

    </x-slot>
    <div class="mt-3">
        @if (session('info'))
            <div class="w-full py-4 px-6 bg-green-500 font-bold rounded-sm mb-3  text-white">
                {{ session('info') }}
            </div>
        @endif

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="">
                    <th scope="col" class="py-3 px-6">N°</th>
                    <th scope="col" class="py-3 px-6">Nombre</th>
                    <th scope="col" class="py-3 px-6"> Dni</th>
                    <th scope="col" class="py-3 px-6"> Fecha Nacimiento</th>
                    <th scope="col" class="py-3 px-6"> Direccion</th>
                    <th scope="col" class="py-3 px-6"> Telefono</th>
                    <th scope="col" class="py-3 px-6" colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr
                        class="{{ $loop->odd ? 'bg-gray-50 dark:bg-gray-900' : 'bg-white dark:bg-gray-800' }} border-b  dark:border-gray-700">
                        <td class="py-4 px-6">{{ $client->id }}</td>
                        <td class="py-4 px-6">{{ $client->name }}</td>
                        <td class="py-4 px-6">{{ $client->document }}</td>
                        <td class="py-4 px-6">{{ $client->date_birthday }}</td>
                        <td class="py-4 px-6">{{ $client->address }}</td>
                        <td class="py-4 px-6">{{ $client->phone }}</td>
                        <td class="py-4 px-2">
                            <a href="{{ route('clients.edit', $client) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">editar</a>
                        </td>
                        <td class="py-4 px-2">
                            <form action="{{ route('clients.destroy', $client) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">elimanar</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
</x-app-layout>
