<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>
  <link rel="stylesheet" href="/css/styles.css">
<main>
@yield('content')
</main>

</x-app-layout>
@yield('scripts')