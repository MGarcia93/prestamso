<div class=" mt-5  pt-7">
    @csrf

    <div class="shadow sm:overflow-hidden sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-6 sm:col-span-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="@isset($client){{ $client->name }} @else {{ old('name') }} @endisset">
                    @error('name')
                        <small class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="document" class="block text-sm font-medium text-gray-700">Dni:</label>
                    <input type="text" name="document" id="document"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="@isset($client){{ $client->document }} @else {{ old('document') }} @endisset">
                    @error('document')
                        <small class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="date_birthday" class="block text-sm font-medium text-gray-700">Fecha Nacimiento:</label>
                    <input type="date" name="date_birthday" id="date_birthday"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="@isset($client){{ $client->date_birthday }}@else{{ old('data_birthday') }}@endisset">
                    @error('date_birthday')
                        <small class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Direccion:</label>
                    <input type="text" name="address" id="address"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="@isset($client){{ $client->address }} @else {{ old('address') }} @endisset">
                    @error('address')
                        <small class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefono:</label>
                    <input type="text" name="phone" id="phone"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="@isset($client){{ $client->phone }} @else {{ old('phone') }} @endisset">
                    @error('phone')
                        <small class="bg-red-500 text-white w-full p-2 rounded-sm block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-4 flex justify-center">
                    <button type="submit"
                        class="focus:outline-none min-w-[100px] text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 
                         dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        @isset($client)
                            Modificar
                        @else
                            Crear
                        @endisset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
