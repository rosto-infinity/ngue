@extends('layout')

@section('content')
<!-- Contenu principal -->
<div class="pt-24 px-6 relative overflow-hidden">
    <!-- Animation de fond -->
    <div class="absolute top-0 left-0 w-full h-full opacity-20 bg-gradient-to-br from-teal-500 via-indigo-500 to-purple-600 blur-3xl"></div>

    <div class="max-w-7xl mx-auto mt-8 relative z-10 text-center">
        <!-- Logo et nom -->
        <div class="flex justify-center items-center mb-4 space-x-4" id="logo-section">
            <img src="{{ asset('images/logi.jpg') }}" alt="Ngue Ngan Result" class="w-16 h-16 rounded-full shadow-lg">
            <span class="text-white text-3xl font-bold">Ngue Ngan Result</span>
        </div>

        <!-- Grand Titre animé -->
        <h1 id="animated-title" class="text-4xl md:text-5xl font-extrabold text-white mb-4 text-center leading-tight">Bienvenue sur la page de gestion des apprenants</h1>
        <p class="text-gray-400 text-center mb-12 text-lg">Ajoutez, modifiez et gérez facilement vos étudiants</p>

        <!-- Bouton Ajouter -->
        <div class="flex justify-center mb-8">
            <a href="{{ route('students.create') }}" class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold px-8 py-4 rounded-full shadow-lg transition-transform transform hover:scale-105" id="add-student-btn">
                + Ajouter un apprenant
            </a>
        </div>

        <!-- Message de succès animé -->
        @if (session()->has('success'))
            <div id="success-message" class="fixed top-20 right-5 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg hidden z-50">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- Message d'erreur (optionnel) -->
        @if (session()->has('error'))
            <div id="error-message" class="fixed top-20 right-5 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg hidden z-50">
                {{ session()->get('error') }}
            </div>
        @endif

        <!-- Tableau -->
        <div class="bg-[#112825]/90 rounded-2xl shadow-2xl overflow-hidden border border-gray-700 backdrop-blur-md">
            <table class="w-full text-white">
                <thead>
                    <tr class="bg-gradient-to-r from-teal-600 to-teal-800 text-white uppercase text-sm tracking-wider">
                        <th class="py-5 px-6 text-left">#</th>
                        <th class="py-5 px-6 text-left">Prénom</th>
                        <th class="py-5 px-6 text-left">Nom</th>
                        <th class="py-5 px-6 text-left">Email</th>
                        <th class="py-5 px-6 text-left">Mobile</th>
                        <th class="py-5 px-6 text-left">Filière</th>
                        <th class="py-5 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="border-b border-gray-700 hover:bg-gray-900/70 transition-all duration-300">
                            <td class="py-4 px-6">{{ $student->id }}</td>
                            <td class="py-4 px-6 font-medium text-gray-200">{{ $student->firstname }}</td>
                            <td class="py-4 px-6 font-medium text-gray-200">{{ $student->lastname }}</td>
                            <td class="py-4 px-6 text-gray-300">{{ $student->email }}</td>
                            <td class="py-4 px-6 text-gray-300">{{ $student->mobile }}</td>
                            <td class="py-4 px-6 text-gray-300">{{ $student->filiere->name }}</td>
                            <td class="py-4 px-6 flex space-x-2">
                                <a href="{{ route('students.edit', $student->id) }}" class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-full shadow-md transition-transform transform hover:scale-105">
                                    Modifier
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500/20 hover:bg-red-500/50 text-red-400 px-4 py-2 rounded-full transition-transform transform hover:scale-105">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-[#0B1120] text-gray-300 py-16 mt-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('images/logi.jpg') }}" alt="Ngue Ngan Result" class="w-10 h-10 rounded-full shadow">
                <h2 class="text-2xl font-bold text-white">Ngue Ngan Result</h2>
            </div>
            <p class="text-gray-400">Plateforme de gestion des résultats et des apprenants pour un suivi optimal et sécurisé.</p>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-white mb-4">Liens rapides</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-teal-400">Accueil</a></li>
                <li><a href="#" class="hover:text-teal-400">Ajouter un étudiant</a></li>
                <li><a href="#" class="hover:text-teal-400">Liste des étudiants</a></li>
                <li><a href="#" class="hover:text-teal-400">Contact</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-white mb-4">Suivez-nous</h3>
            <div class="flex space-x-4">
                <a href="#" class="text-2xl hover:text-blue-500 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-2xl hover:text-sky-400 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-2xl hover:text-pink-500 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-2xl hover:text-blue-600 transition"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-white mb-4">Contact</h3>
            <ul class="space-y-2 text-gray-400">
                <li><i class="fas fa-map-marker-alt mr-2"></i> Douala, Cameroun</li>
                <li><i class="fas fa-envelope mr-2"></i> contact@ngueganresult.cm</li>
                <li><i class="fas fa-phone mr-2"></i> +237 6 99 99 99 99</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-700 mt-12 pt-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} Ngue Ngan Result - Tous droits réservés.
    </div>
</footer>

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<!-- SweetAlert2 pour les alertes -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Vérification que GSAP est chargé
if (typeof gsap === 'undefined') {
    console.error("GSAP n'est pas chargé. Vérifiez le CDN ou le chemin du script.");
}

// Méthodes pour les animations et la gestion des interactions
const AnimationManager = {
    // Animation du titre
    animateTitle() {
        const title = document.getElementById("animated-title");
        if (title) {
            gsap.from(title, {
                opacity: 0,
                y: -50,
                duration: 1.5,
                ease: "power2.out"
            });
        } else {
            console.error("Élément #animated-title non trouvé.");
        }
    },

    // Animation du logo et nom
    animateLogo() {
        const logo = document.getElementById("logo-section");
        if (logo) {
            gsap.from(logo, {
                opacity: 0,
                scale: 0.8,
                duration: 1,
                ease: "back.out(1.7)"
            });
        } else {
            console.error("Élément #logo-section non trouvé.");
        }
    },

    // Animation du bouton "Ajouter"
    animateAddButton() {
        const button = document.getElementById("add-student-btn");
        if (button) {
            gsap.from(button, {
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power2.out",
                delay: 0.5
            });
        } else {
            console.error("Élément #add-student-btn non trouvé.");
        }
    },

    // Gestion des messages (succès ou erreur)
    showMessage(type) {
        const successMessage = document.getElementById("success-message");
        const errorMessage = document.getElementById("error-message");

        if (type === 'success' && successMessage) {
            successMessage.classList.remove("hidden");
            gsap.fromTo(successMessage, 
                { opacity: 0, y: -20 }, 
                { opacity: 1, y: 0, duration: 1, ease: "power2.out" }
            );
            setTimeout(() => {
                gsap.to(successMessage, {
                    opacity: 0,
                    y: 20,
                    duration: 1,
                    ease: "power2.in",
                    onComplete: () => successMessage.classList.add("hidden")
                });
            }, 5000);
        } else if (type === 'error' && errorMessage) {
            errorMessage.classList.remove("hidden");
            gsap.fromTo(errorMessage, 
                { opacity: 0, y: -20 }, 
                { opacity: 1, y: 0, duration: 1, ease: "power2.out" }
            );
            setTimeout(() => {
                gsap.to(errorMessage, {
                    opacity: 0,
                    y: 20,
                    duration: 1,
                    ease: "power2.in",
                    onComplete: () => errorMessage.classList.add("hidden")
                });
            }, 5000);
        }
    },

    // Gestion de la confirmation de suppression
    handleDeleteConfirmation() {
        document.querySelectorAll(".delete-form").forEach(form => {
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Attention, confirmation requise !",
                    text: "Voulez-vous vraiment supprimer cet apprenant ? Cette action est irréversible et effacera toutes ses données associées.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0f172a",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Oui, je confirme la suppression",
                    cancelButtonText: "Non, annuler"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    },

    // Initialisation des animations et messages
    init() {
        this.animateTitle();
        this.animateLogo();
        this.animateAddButton();
        this.showMessage('success');
        this.showMessage('error');
        this.handleDeleteConfirmation();
    }
};

// Lancer les animations une fois le DOM chargé
document.addEventListener("DOMContentLoaded", () => {
    AnimationManager.init();
});
</script>
@endsection