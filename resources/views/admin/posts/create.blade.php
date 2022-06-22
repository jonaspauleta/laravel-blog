<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input required name="title"/>
            <x-form.input required name="thumbnail" type="file"/>
            <x-form.textarea name="excerpt" />
            <x-form.textarea name="body" />

            <x-form.section>
                <x-form.label name="category"/>

                <select name="category_id" id="category_id">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error name="category"/>
            </x-form.section>

            <x-form.button>
                Publish
            </x-form.button>
        </form>
    </x-setting>
</x-layout>