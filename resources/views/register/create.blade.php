<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Register</h1>

                <form class="mt-10" method="POST" action="/register">
                    @csrf

                    <x-form.input required name="name" type="text" autocomplete="name"/>
                    <x-form.input required name="username" type="text" autocomplete="username"/>
                    <x-form.input required name="email" type="email" autocomplete="email"/>
                    <x-form.input required name="password" type="password" autocomplete="password"/>

                    <x-form.button>
                        Submit
                    </x-form.button>

                    @if ($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-red-500 text-xs">{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
