<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Soal</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden p-8">
                <form method="POST" id="updateForm" action="{{ route('questions.update', $question->id) }}" enctype="multipart/form-data">
                    {{-- biasakan ingat enctype="multipart/form-data" buat upload gambar/data karena jika tidak gak bakalan terkirim ke server,intinya digunakan buat ngimir form ke server--}}
                    @csrf
                    @method('PUT')

                    @include('admin.questions._form')
                </form>
            </div>

            
            <div class="flex justify-end mt-6">
                <button type="submit" form="updateForm"
                    class="bg-[#1A2B3E] text-white px-6 py-3 rounded-xl shadow hover:bg-black transition">
                    Update
                </button>
            </div>

        </div>
    </div>

</x-app-layout>
