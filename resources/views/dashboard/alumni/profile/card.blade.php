<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Alumni - {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Desain untuk kartu (ukuran kartu standar: sekitar 85.60 mm × 53.98 mm) */
        .alumni-card {
            width: 338px; /* Sekitar 8.56 cm x 96dpi */
            height: 212px; /* Sekitar 5.398 cm x 96dpi */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
            position: relative;
            /* Latar belakang gradien kuning/oranye */
            background: linear-gradient(135deg, #FACC15 0%, #F59E0B 100%); /* Kuning ke Oranye */
            color: #333; /* Warna teks gelap agar kontras dengan kuning */
            padding: 1rem;
        }

        /* Cetak (print) styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
                font-size: 10pt;
            }
            .alumni-card {
                margin: 0;
                padding: 0.5rem;
                width: 85.6mm;
                height: 53.98mm;
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-after: always;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen no-print">
    <div class="p-4 no-print">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-print mr-2"></i> Cetak Kartu Ini
        </button>
        <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
            <i class="fas fa-times mr-2"></i> Tutup
        </button>
    </div>

    <div class="alumni-card">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-xl font-extrabold text-white drop-shadow-md">ALUMNI GARNISSA</h1>
            {{-- Anda bisa menambahkan logo sekolah di sini jika ada --}}
            {{-- <img src="{{ asset('path/to/your/school_logo.png') }}" alt="Logo Sekolah" class="h-8 w-auto"> --}}
        </div>

        <div class="flex items-center mb-4">
            <div class="w-24 h-24 rounded-full border-3 border-white flex-shrink-0 mr-4 overflow-hidden shadow-md">
                <img src="{{ optional($user->alumniProfile)->image ? asset('storage/' . $user->alumniProfile->image) : 'https://placehold.co/96x96/FFEDD5/D97706?text=FOTO' }}"
                     alt="Profil" class="w-full h-full object-cover">
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-700">Jurusan: {{ $user->major->name ?? 'N/A' }}</p>
                <p class="text-sm text-gray-700">Angkatan: {{ optional($user->alumniProfile)->graduation_year ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
            <div class="text-sm text-gray-800">
                <p class="font-semibold">Kode Alumni:</p>
                <p class="text-base font-bold">{{ optional($user->alumniProfile)->alumni_code ?? 'N/A' }}</p>
            </div>
            <div id="barcode-container" class="w-32 h-12 bg-white p-1 rounded shadow-sm">
                {{-- Barcode akan di-generate di sini --}}
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menghasilkan SVG barcode Code 39
        function generateBarcode(text, containerId) {
            const container = document.getElementById(containerId);
            if (!container) {
                console.error("Barcode container not found:", containerId);
                return;
            }

            // Code 39 mapping (subset untuk contoh sederhana)
            const code39 = {
                '0': 'nNwBnWnNn', '1': 'NnNwBnNnN', '2': 'nNnWBnNnN', '3': 'NNnWBnNnN',
                '4': 'nNwBNnNnN', '5': 'NNwBNnNnN', '6': 'nNnWBnNnN', '7': 'nNwBnNnN',
                '8': 'NNwBnNnN', '9': 'nNnWBnNnN', 'A': 'NnNnBwNnN', 'B': 'nNnNBwNnN',
                'C': 'NNnNBwNnN', 'D': 'nNwNBNnN', 'E': 'NNwNBNnN', 'F': 'nNnWBnNnN',
                'G': 'nNnNBNwN', 'H': 'NNnNBNwN', 'I': 'nNnNBNwN', 'J': 'nNwNBNwN',
                'K': 'NnNnNwBnN', 'L': 'nNnNNwBnN', 'M': 'NNnNNwBnN', 'N': 'nNwNNwBnN',
                'O': 'NNwNNwBnN', 'P': 'nNnNNwBnN', 'Q': 'nNnNnWBnN', 'R': 'NNnNnWBnN',
                'S': 'nNnNnWBnN', 'T': 'nNwNnWBnN', 'U': 'NnNnNwNnB', 'V': 'nNnNNwNnB',
                'W': 'NNnNNwNnB', 'X': 'nNwNNwNnB', 'Y': 'NNwNNwNnB', 'Z': 'nNnNNwNnB',
                '-': 'nNwNnNnB', '.': 'NNwNnNnB', ' ': 'nNnNNwNnB', '$': 'nNnNnNnW',
                '/': 'nNnNnNnW', '+': 'nNnNnNnW', '%': 'nNnNnNnW', '*': 'nNwNnNnN' // Start/Stop character
            };

            // Tambahkan karakter start/stop '*'
            let barcodeData = '*' + text.toUpperCase() + '*';
            let svgContent = '';
            const barWidth = 1; // Lebar bar tipis
            const wideBarWidth = 3; // Lebar bar tebal (3x bar tipis)
            const spaceWidth = 1; // Lebar spasi tipis
            const wideSpaceWidth = 3; // Lebar spasi tebal (3x spasi tipis)
            let currentX = 0;

            for (let i = 0; i < barcodeData.length; i++) {
                const char = barcodeData[i];
                const pattern = code39[char];

                if (!pattern) {
                    console.warn("Karakter tidak didukung oleh Code 39:", char);
                    continue;
                }

                for (let j = 0; j < pattern.length; j++) {
                    const type = pattern[j]; // n=narrow, N=wide, w=white, B=black

                    let width = 0;
                    let color = 'white';

                    if (type === 'n') { // narrow black bar
                        width = barWidth;
                        color = 'black';
                    } else if (type === 'N') { // wide black bar
                        width = wideBarWidth;
                        color = 'black';
                    } else if (type === 'w') { // narrow white space (implied by next bar's start)
                        width = spaceWidth;
                        color = 'white';
                    } else if (type === 'W') { // wide white space
                        width = wideSpaceWidth;
                        color = 'white';
                    } else if (type === 'B') { // wide black bar
                        width = wideBarWidth;
                        color = 'black';
                    } else if (type === 'b') { // narrow black bar
                        width = barWidth;
                        color = 'black';
                    }

                    if (color === 'black') {
                        svgContent += `<rect x="${currentX}" y="0" width="${width}" height="100%" fill="black"/>`;
                    }
                    currentX += width;
                }
                // Tambahkan inter-character gap (narrow white space)
                currentX += spaceWidth;
            }

            const svgWidth = currentX;
            const svgHeight = 50; // Tinggi barcode

            container.innerHTML = `
                <svg width="100%" height="100%" viewBox="0 0 ${svgWidth} ${svgHeight}" preserveAspectRatio="none">
                    ${svgContent}
                </svg>
            `;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const alumniCode = "{{ optional($user->alumniProfile)->alumni_code ?? '1234567890' }}"; // Ambil kode alumni
            if (alumniCode !== 'N/A' && alumniCode !== '') {
                generateBarcode(alumniCode, 'barcode-container');
            } else {
                // Tampilkan pesan jika kode alumni tidak tersedia
                document.getElementById('barcode-container').innerHTML = '<p class="text-center text-xs text-gray-500">Kode Alumni tidak tersedia</p>';
            }
        });
    </script>
</body>
</html>
