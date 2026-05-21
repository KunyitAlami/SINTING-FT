<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website SINTING-FT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- KIRI: gambar -->
        <div 
            class="relative min-h-[300px] md:min-h-screen bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('background.jpg') }}'); filter: brightness(55%);"
        >
        </div>

        <!-- KANAN: form login -->
        <div class="min-h-screen flex flex-col items-center justify-center bg-white px-10">
            <div class="text-center mb-10">
                <h1 class="text-6xl font-bold mb-4 text-gray-900">
                    SINTING-FT
                </h1>
                <p class="text-xl text-gray-600 font-bold">
                    Sistem Informasi Berbasis Blockchain <br>Untuk Voting di Fakultas Teknik Universitas Lambung Mangkurat
                </p>
            </div>
            <div class="w-full max-w-md">


            <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                @csrf

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div>
                    <input 
                        type="text" 
                        name="nim"
                        placeholder="Masukkan NIM"
                        value="{{ old('nim') }}"
                        class="w-full px-5 py-4 rounded-full bg-gray-200 text-gray-700 outline-none focus:ring-2 focus:ring-green-800"
                    >

                    @error('nim')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="password" 
                        name="password"
                        placeholder="Masukkan Kata Sandi"
                        class="w-full px-5 py-4 rounded-full bg-gray-200 text-gray-700 outline-none focus:ring-2 focus:ring-green-800"
                    >

                    @error('password')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full mt-4 px-10 py-4 bg-green-800 text-white rounded-full font-bold hover:bg-green-900 transition"
                >
                    Masuk
                </button>
            </form>
            </div>
        </div>

    </div>
</body>
</html>