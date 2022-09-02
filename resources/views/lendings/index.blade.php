<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de prestamos activos
        </h2>
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
                    <th scope="col" class="py-3 px-6">CLIENTE</th>
                    <th scope="col" class="py-3 px-6">PRESTADO</th>
                    <th scope="col" class="py-3 px-6">FECHA</th>
                    <th scope="col" class="py-3 px-6">COUTAS</th>
                    <th scope="col" class="py-3 px-6">CUETA ACTUAL</th>
                    <th scope="col" class="py-3 px-6">PROXIMO PAGO</th>
                    <th scope="col" class="py-3 px-6">DEBE</th>
                    <th scope="col" class="py-3 px-6"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lendings as $lending)
                    <tr
                        class="{{ $loop->odd ? 'bg-gray-50 dark:bg-gray-900' : 'bg-white dark:bg-gray-800' }} border-b  dark:border-gray-700">
                        <td class="py-4 px-6">{{ $lending->id }}</td>
                        <td class="py-4 px-6">{{ $lending->client->name }}</td>
                        <td class="py-4 px-6">${{ $lending->amount_number }}</td>
                        <td class="py-4 px-6">{{ $lending->date }}</td>
                        <td class="py-4 px-6">{{ $lending->dues_quantity }}</td>
                        <td class="py-4 px-6">{{ $lending->dues_current }}</td>
                        <td class="py-4 px-6">{{ $lending->nextPayment() }}</td>
                        <td class="py-4 px-6">${{ $lending->must() }}</td>
                        <td class="py-4 px-6">
                            <a href="{{ route('lendings.edit', $lending) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">editar</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
