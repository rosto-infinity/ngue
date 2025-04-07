<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistiques</title>
    <link rel="shortcut icon" href="{{ asset('images/logi.jpg') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jsPDF CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            background: linear-gradient(to bottom right, #1f2937, #111827);
            color: #e5e7eb;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            border: 1px solid rgba(99, 102, 241, 0.5);
        }
        .title-typing {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            animation: typing 2s steps(40, end), pulse 1.5s infinite;
        }
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .desc-slide {
            animation: slideIn 1.5s ease-in-out;
        }
        @keyframes slideIn {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        .chart-loading {
            background: linear-gradient(90deg, #374151, #4b5563, #374151);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="min-h-screen font-sans">
    <!-- En-tête fixe avec logo et boutons -->
    <header class="fixed top-0 left-0 w-full bg-gray-900 p-4 shadow-lg z-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="/images/logi.jpg" alt="Logo NgueNganResult" class="h-10 w-auto">
                <span class="text-3xl font-extrabold text-white">NgueNgan<span class="text-teal-400">Result</span></span>
            </div>
            <div class="flex space-x-4  ">
                {{-- <a href="" ></a> --}}
                <a class="bg-indigo-700 items-center text-center hover:bg-white   text-white px-4 py-2 rounded-lg flex  "  href="http://127.0.0.1:8000/students"
                {{-- <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>  --}}
                
                >Retour</a>

                <button id="export-pdf-btn" class="bg-indigo-700 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg">Exporter en PDF</button>
            </div>
        </div>
    </header>

    <div class="container mx-auto p-6 max-w-6xl mt-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Carte Examens -->
            <div class="col-span-2 fade-in">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-200 title-typing flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Statistiques par Examen
                    </h2>
                    <div class="bg-indigo-700 text-white p-2 rounded-lg shadow-lg">
                        <p class="text-sm">Total Étudiants</p>
                        <p id="total-students" class="text-lg font-bold">150</p>
                    </div>
                </div>
                <div class="flex gap-2 mb-4">
                    <button onclick="switchChart('examChart', 'bar')" class="bg-indigo-700 hover:bg-indigo-600 text-white px-3 py-1 rounded">Barres</button>
                    <button onclick="switchChart('examChart', 'line')" class="bg-indigo-700 hover:bg-indigo-600 text-white px-3 py-1 rounded">Lignes</button>
                </div>
                <div class="bg-gray-800 p-4 rounded-xl shadow-lg card-hover">
                    <canvas id="examChart" class="w-full h-64 chart-loading"></canvas>
                </div>
                <div class="bg-gray-900 p-4 mt-4 rounded-xl shadow-lg card-hover desc-slide">
                    <p class="text-gray-300 text-sm">
                        Pour lire : Le graphique à barres montre la moyenne des notes (barres bleues) et le nombre d’étudiants (barres jaunes) par examen (ID sur l’axe horizontal). Exemple : Pour l’examen ID 1, si la barre bleue atteint 15 et la jaune 30, cela signifie une moyenne de 15/20 avec 30 étudiants. Comparez les hauteurs pour évaluer performance et participation.
                    </p>
                </div>
                <div class="bg-gray-800 p-4 mt-4 rounded-xl shadow-lg card-hover overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-indigo-700 text-white">
                                <th class="px-4 py-2 text-left rounded-tl-xl">ID</th>
                                <th class="px-4 py-2 text-left">Moyenne</th>
                                <th class="px-4 py-2 text-left rounded-tr-xl">Étudiants</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examStatistics as $stat)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-2">{{ $stat->exam_id }}</td>
                                <td class="px-4 py-2">{{ $stat->average_note }}</td>
                                <td class="px-4 py-2">{{ $stat->number_of_students }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Carte Filières -->
            <div class="fade-in">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-200 mb-4 title-typing flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 1.857a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Statistiques par Filière
                    </h2>
                    <div class="bg-indigo-700 text-white p-2 rounded-lg shadow-lg">
                        <p class="text-sm">Filières</p>
                        <p class="text-lg font-bold">5</p>
                    </div>
                </div>
                <div class="bg-gray-800 p-4 rounded-xl shadow-lg card-hover">
                    <canvas id="filiereChart" class="w-full h-64 chart-loading"></canvas>
                </div>
                <div class="bg-gray-900 p-4 mt-4 rounded-xl shadow-lg card-hover desc-slide">
                    <p class="text-gray-300 text-sm">
                        Pour lire : Le graphique en camembert montre la répartition des étudiants par filière (noms à droite). Chaque section colorée indique une filière et sa taille le nombre d’étudiants. Exemple : Si la section turquoise ‘Informatique’ occupe 50% du cercle, cela signifie que 50% des étudiants sont en Informatique.
                    </p>
                </div>
            </div>

            <!-- Carte Grades -->
            <div class="fade-in">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-200 mb-4 title-typing flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        Statistiques par Grade
                    </h2>
                    <div class="bg-indigo-700 text-white p-2 rounded-lg shadow-lg">
                        <p class="text-sm">Moyenne</p>
                        <p class="text-lg font-bold">14.5</p>
                    </div>
                </div>
                <div class="bg-gray-800 p-4 rounded-xl shadow-lg card-hover">
                    <canvas id="gradeChart" class="w-full h-64 chart-loading"></canvas>
                </div>
                <div class="bg-gray-900 p-4 mt-4 rounded-xl shadow-lg card-hover desc-slide">
                    <p class="text-gray-300 text-sm">
                        Pour lire : Le graphique à barres montre le nombre d’étudiants par grade (grades sur l’axe horizontal). La hauteur des barres (axe vertical) indique le compte. Exemple : Si la barre pour ‘A’ atteint 25, cela signifie que 25 étudiants ont obtenu le grade A. Comparez les hauteurs pour voir la répartition.
                    </p>
                </div>
            </div>

            <!-- Table Filières -->
            <div class="fade-in">
                <h3 class="text-xl font-semibold text-gray-300 mb-4 title-typing flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Détails Filières
                </h3>
                <div class="bg-gray-800 p-4 rounded-xl shadow-lg card-hover overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-indigo-700 text-white">
                                <th class="px-4 py-2 text-left rounded-tl-xl">Filière</th>
                                <th class="px-4 py-2 text-left rounded-tr-xl">Étudiants</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filiereStatistics as $filiere)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-2">{{ $filiere->name }}</td>
                                <td class="px-4 py-2">{{ $filiere->students_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table Grades (corrigée) -->
            <div class="fade-in">
                <h3 class="text-xl font-semibold text-gray-300 mb-4 title-typing flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Détails Grades
                </h3>
                <div class="bg-gray-800 p-4 rounded-xl shadow-lg card-hover overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-indigo-700 text-white">
                                <th class="px-4 py-2 text-left rounded-tl-xl">Grade</th>
                                <th class="px-4 py-2 text-left rounded-tr-xl">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gradeStatistics as $gradeStat)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-2">{{ $gradeStat->grade }}</td>
                                <td class="px-4 py-2">{{ $gradeStat->count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour les graphiques, temps réel WebSocket et export PDF -->
    <script>
        const { jsPDF } = window.jspdf;

        // Fonction pour basculer entre types de graphiques
        function switchChart(chartId, type) {
            const chart = Chart.getChart(chartId);
            chart.config.type = type;
            chart.update();
        }

        // Graphique Examens avec dégradé
        const examCtx = document.getElementById('examChart').getContext('2d');
        const gradientBlue = examCtx.createLinearGradient(0, 0, 0, 400);
        gradientBlue.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
        gradientBlue.addColorStop(1, 'rgba(99, 102, 241, 0.2)');
        const gradientYellow = examCtx.createLinearGradient(0, 0, 0, 400);
        gradientYellow.addColorStop(0, 'rgba(234, 179, 8, 0.8)');
        gradientYellow.addColorStop(1, 'rgba(234, 179, 8, 0.2)');

        let examLabels = @json($examStatistics->pluck('exam_id'));
        let examData = @json($examStatistics->pluck('average_note'));
        let examCount = @json($examStatistics->pluck('number_of_students'));

        const examChart = new Chart(examCtx, {
            type: 'bar',
            data: {
                labels: examLabels,
                datasets: [{
                    label: 'Moyenne des Notes',
                    data: examData,
                    backgroundColor: gradientBlue,
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1
                }, {
                    label: 'Nombre d\'Étudiants',
                    data: examCount,
                    backgroundColor: gradientYellow,
                    borderColor: 'rgba(234, 179, 8, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#d1d5db' } },
                    x: { grid: { display: false }, ticks: { color: '#d1d5db' } }
                },
                plugins: { legend: { position: 'top', labels: { color: '#e5e7eb' } } }
            }
        });

        // Graphique Filières
        const filiereCtx = document.getElementById('filiereChart').getContext('2d');
        const filiereLabels = @json($filiereStatistics->pluck('name'));
        const filiereCounts = @json($filiereStatistics->pluck('students_count'));

        const filiereChart = new Chart(filiereCtx, {
            type: 'pie',
            data: {
                labels: filiereLabels,
                datasets: [{
                    data: filiereCounts,
                    backgroundColor: ['#4BC0C0', '#9966FF', '#FF9F40', '#36A2EB', '#FF6384'],
                    borderWidth: 1,
                    borderColor: '#1f2937'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right', labels: { color: '#e5e7eb' } } }
            }
        });

        // Graphique Grades avec dégradé
        const gradeCtx = document.getElementById('gradeChart').getContext('2d');
        const gradientRed = gradeCtx.createLinearGradient(0, 0, 0, 400);
        gradientRed.addColorStop(0, 'rgba(255, 99, 132, 0.8)');
        gradientRed.addColorStop(1, 'rgba(255, 99, 132, 0.2)');

        const gradeLabels = @json($gradeStatistics->pluck('grade'));
        const gradeCounts = @json($gradeStatistics->pluck('count'));

        const gradeChart = new Chart(gradeCtx, {
            type: 'bar',
            data: {
                labels: gradeLabels,
                datasets: [{
                    label: 'Nombre d\'Étudiants par Grade',
                    data: gradeCounts,
                    backgroundColor: gradientRed,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#d1d5db' } },
                    x: { grid: { display: false }, ticks: { color: '#d1d5db' } }
                },
                plugins: { legend: { position: 'top', labels: { color: '#e5e7eb' } } }
            }
        });

        // Retirer l'effet de chargement après rendu initial
        setTimeout(() => {
            document.querySelectorAll('.chart-loading').forEach(el => el.classList.remove('chart-loading'));
        }, 1000);

        // Mise à jour en temps réel avec WebSocket
        const socket = new WebSocket('ws://localhost:6001');

        socket.onopen = () => {
            console.log('Connexion WebSocket établie');
            socket.send(JSON.stringify({ event: 'subscribe', channel: 'exam-statistics' }));
        };

        socket.onmessage = (event) => {
            const data = JSON.parse(event.data);
            if (data.event === 'exam-update') {
                // Mise à jour du badge
                document.querySelector('#total-students').textContent = data.totalStudents;

                // Mise à jour du graphique Examens
                examChart.data.labels = data.examLabels;
                examChart.data.datasets[0].data = data.examData;
                examChart.data.datasets[1].data = data.examCount;
                examChart.update();
            }
        };

        socket.onerror = (error) => {
            console.error('Erreur WebSocket:', error);
        };

        socket.onclose = () => {
            console.log('Connexion WebSocket fermée');
        };

        // Exportation en PDF
        document.querySelector('#export-pdf-btn').addEventListener('click', () => {
            const doc = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });
            doc.html(document.querySelector('.container'), {
                callback: function (doc) {
                    doc.save('dashboard.pdf');
                },
                x: 10,
                y: 10,
                width: 190,
                windowWidth: 1000
            });
        });
    </script>
</body>
</html>