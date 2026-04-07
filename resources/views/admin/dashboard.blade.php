<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">
            Admin Dashboard
        </h1>

        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-lg font-semibold">Total User</h2>
                <p class="text-3xl font-bold mt-2">
                    {{ $totalUsers }}
                </p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-lg font-semibold">Total Soal</h2>
                <p class="text-3xl font-bold mt-2">
                    {{ $totalQuestions }}
                </p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-lg font-semibold">Total Tryout</h2>
                <p class="text-3xl font-bold mt-2">
                    {{ $totalTryouts }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
