<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Prestamo
        </h2>
    </x-slot>
    <form action="{{ route('lendings.store') }}" method="post">
        <div class="grid md:grid-cols-2 gap-2 mt-5  pt-7">
            @csrf
            <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                    <h2 class="uppercase">Datos del prestamo</h2>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">FECHA:</label>
                            <input type="date" name="date" id="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('date')
                                <small
                                    class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="lender_id" class="block text-sm font-medium text-gray-700">PRESTADOR:</label>
                            <select id="lender_id" name="lender_id" autocomplete="lender_id-name"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @foreach ($lenders as $lender)
                                    <option value="{{ $lender->id }}">{{ $lender->name }}</option>
                                @endforeach
                            </select>
                            @error('lender_id')
                                <small
                                    class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="amount_number" class="block text-sm font-medium text-gray-700">CANTIDAD EN
                                NUMERO:</label>
                            <input type="number" name="amount_number" id="amount_number" autocomplete="2000.00"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('amount_number')
                                <small
                                    class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="amount_word" class="block text-sm font-medium text-gray-700">CANTIDAD EN
                                LETRA:</label>
                            <input type="text" name="amount_word" id="amount_word" autocomplete="Dos mil"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('amount_word')
                                <small
                                    class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="dues_quantity" class="block text-sm font-medium text-gray-700">Cuotas:</label>
                            <input type="number" name="dues_quantity" id="dues_quantity" autocomplete="2000.00"
                                max="36"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('dues_quantity')
                                <small
                                    class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="">
                <div class="space-y-6  bg-white px-4 py-5 sm:p-6 shadow sm:overflow-hidden sm:rounded-md ">
                    <h2 class="uppercase">DATOS DEL CLIENTE</h2>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="client_id" class="block text-sm font-medium text-gray-700">NOMBRE:</label>
                            <select id="client_id" name="client_id" autocomplete="99999999"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" data-document="{{ $client->document }}">
                                        {{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="document" class="block text-sm font-medium text-gray-700">DNI:</label>
                            <input type="text" name="document" id="document" readonly
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 text-center sm:px-6">
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white w-full p-2 rounded-sm block mt-1 shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Generar</button>
        </div>
    </form>
    <script>
        document.getElementById('client_id').addEventListener('change', function() {
            console.log(this.options[this.options.selectedIndex].innerText, document.getElementById('name'));
            document.getElementById('document').value = this.options[this.options.selectedIndex].getAttribute(
                'data-document');
        })
        document.getElementById('client_id').dispatchEvent(new Event('change'))
    </script>

</x-app-layout>
