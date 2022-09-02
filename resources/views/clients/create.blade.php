<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buevo cliente
        </h2>
    </x-slot>
    <form action="{{ route('clients.store') }}" method="post">
        @include('clients.partials.form')
    </form>
</x-app-layout>
