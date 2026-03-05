<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $annonce->titre }} - Mini-Rb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm py-4 px-8 flex justify-between items-center border-b sticky top-0 z-50">
        <div class="flex items-center space-x-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-rose-500 hover:text-rose-600 transition">
                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 fill-current" aria-hidden="true" role="presentation" focusable="false"><path d="M16 1c2.008 0 3.463.963 4.751 3.269l.533 1.025c1.954 3.83 6.114 12.54 7.1 14.836l.145.353c.667 1.591.91 2.472.96 3.396l.01.415v.301c0 4.262-2.87 7.405-6.66 7.405-2.008 0-3.463-.963-4.751-3.269l-.533-1.025c-1.954-3.83-6.114-12.54-7.1-14.836l-.145-.353c-.667-1.591-.91-2.472-.96-3.396l-.01-.415v-.301c0-4.262 2.87-7.405 6.66-7.405zm0 2.249c-2.316 0-3.969 1.942-3.969 4.407 0 .793.183 1.54.526 2.366l.135.293c.895 1.91 4.708 9.814 6.69 13.82l.533 1.025c1.025 1.91 1.761 2.41 2.41 2.41.648 0 1.384-.5 2.41-2.41l.533-1.025c1.982-4.006 5.795-11.91 6.69-13.82l.135-.293c.343-.826.526-1.573.526-2.366 0-2.465-1.653-4.407-3.969-4.407-1.353 0-2.355.672-3.327 2.41l-.533 1.025c-1.606 3.104-4.802 9.537-6.31 12.607l-.145.31c-.512 1.03-.895 1.488-1.255 1.488-.36 0-.743-.458-1.255-1.488l-.145-.31c-1.508-3.07-4.704-9.503-6.31-12.607l-.533-1.025c-.972-1.738-1.974-2.41-3.327-2.41zm0 7.842c.648 0 1.384.5 2.41 2.41l.533 1.025c1.606 3.104 4.802 9.537 6.31 12.607l.145.31c.512 1.03.895 1.488 1.255 1.488.36 0 .743-.458 1.255-1.488l.145-.31c1.508-3.07 4.704-9.503 6.31-12.607l.533-1.025c1.025-1.91 1.761-2.41 2.41-2.41s1.384.5 2.41 2.41l.533 1.025c1.982 4.006 5.795 11.91 6.69 13.82l.135.293c.343.826.526 1.573.526 2.366 0 2.465-1.653 4.407-3.969 4.407-2.316 0-3.969-1.942-3.969-4.407 0-.793.183-1.54.526-2.366l.135-.293c.895-1.91 4.708-9.814 6.69-13.82l.533-1.025c1.025-1.91 1.761-2.41 2.41-2.41z"></path></svg>
                <span class="font-bold text-2xl tracking-tighter">Mini-Rb</span>
            </a>

            <!-- Suggestions Menu -->
            <div class="hidden md:flex items-center space-x-6 text-sm font-semibold text-gray-600">
                <div class="group relative py-4">
                    <button class="hover:text-rose-500 transition flex items-center">
                        Pays populaires
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 w-48 bg-white shadow-xl rounded-xl py-2 border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <a href="/?ville=France" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">France</a>
                        <a href="/?ville=Maroc" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Maroc</a>
                        <a href="/?ville=Espagne" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Espagne</a>
                        <a href="/?ville=Italie" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Italie</a>
                        <a href="/?ville=USA" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">États-Unis</a>
                    </div>
                </div>
                <div class="group relative py-4">
                    <button class="hover:text-rose-500 transition flex items-center">
                        Villes populaires
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 w-48 bg-white shadow-xl rounded-xl py-2 border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <a href="/?ville=Paris" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Paris</a>
                        <a href="/?ville=Casablanca" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Casablanca</a>
                        <a href="/?ville=Marrakech" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Marrakech</a>
                        <a href="/?ville=Londres" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Londres</a>
                        <a href="/?ville=Barcelone" class="block px-4 py-2 hover:bg-gray-50 hover:text-rose-500">Barcelone</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('annonces.create') }}" class="text-gray-700 font-semibold hover:text-rose-500 transition">Mettre mon logement sur Mini-Rb</a>
                <span class="text-gray-400">|</span>
                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-rose-500 transition font-semibold text-sm focus:outline-none">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 font-semibold hover:text-rose-500 transition">Connexion</a>
                <a href="{{ route('register') }}" class="bg-rose-500 text-white px-4 py-2 rounded-full font-semibold hover:bg-rose-600 transition">Inscription</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-8 py-10">
        <h1 class="text-3xl font-bold mb-4">{{ $annonce->titre }}</h1>
        <p class="text-gray-600 mb-6 underline font-semibold">{{ $annonce->adresse }}, {{ $annonce->ville }}</p>

        <div class="rounded-2xl overflow-hidden mb-10 h-[500px]">
            @if($annonce->image)
                <img src="{{ Storage::url($annonce->image) }}" alt="{{ $annonce->titre }}" class="w-full h-full object-cover">
            @else
                <img src="https://via.placeholder.com/1200x800?text=Pas+d+image" alt="{{ $annonce->titre }}" class="w-full h-full object-cover">
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="md:col-span-2">
                <div class="flex justify-between items-start mb-2">
                    <h2 class="text-2xl font-bold">Logement entier proposé par {{ $annonce->user->name }}</h2>
                    @can('update', $annonce)
                        <div class="flex space-x-2">
                            <a href="{{ route('annonces.edit', $annonce) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">Modifier</a>
                            <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" onsubmit="return confirm('Supprimer cette annonce ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-100 transition">Supprimer</button>
                            </form>
                        </div>
                    @endcan
                </div>
                <p class="text-gray-600 mb-6 border-b pb-6">{{ $annonce->nombre_de_chambres }} chambre(s)</p>
                
                <h3 class="text-xl font-bold mb-4">À propos de ce logement</h3>
                <p class="text-gray-700 leading-relaxed mb-10">{{ $annonce->description }}</p>

                <!-- Système de notation par étoiles -->
                <div class="border-t pt-8">
                    <h3 class="text-xl font-bold mb-4">Noter ce logement</h3>
                    <div class="flex items-center space-x-2" x-data="{ rating: 0, hover: 0 }">
                        @foreach(range(1, 5) as $star)
                            <button 
                                type="button"
                                @click="rating = {{ $star }}; alert('Merci pour votre note de {{ $star }} étoiles !')"
                                @mouseenter="hover = {{ $star }}"
                                @mouseleave="hover = 0"
                                class="focus:outline-none transition-transform hover:scale-110"
                            >
                                <svg class="w-8 h-8" :class="(hover || rating) >= {{ $star }} ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        @endforeach
                        <span class="ml-4 text-gray-600 font-semibold" x-text="rating > 0 ? rating + ' / 5' : 'Aucune note'"></span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 italic">Notez la qualité du logement et des services.</p>
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="border rounded-2xl p-6 shadow-xl sticky top-10">
                    <p class="text-2xl font-bold mb-6"><span class="text-gray-900">{{ $annonce->prix_par_nuit }}$</span> <span class="text-gray-500 font-normal text-base">par nuit</span></p>
                    
                    <form action="#" method="POST">
                        @csrf
                        <div class="border rounded-lg mb-4">
                            <div class="grid grid-cols-2 border-b">
                                <div class="p-3 border-r">
                                    <label class="block text-[10px] font-bold uppercase">Arrivée</label>
                                    <input type="date" name="date_debut" class="w-full text-sm outline-none">
                                </div>
                                <div class="p-3">
                                    <label class="block text-[10px] font-bold uppercase">Départ</label>6
                                    <input type="date" name="date_fin" class="w-full text-sm outline-none">
                                </div>
                            </div>
                            <div class="p-3">
                                <label class="block text-[10px] font-bold uppercase">Voyageurs</label>
                                <select class="w-full text-sm outline-none bg-transparent">
                                    <option>1 voyageur</option>
                                    <option>2 voyageurs</option>
                                    <option>3 voyageurs</option>
                                    <option>plus..</option>
                                </select>
                            </div>
                        </div>

                        <button type="button" class="w-full bg-rose-500 text-white py-3 rounded-lg font-bold hover:bg-rose-600 transition" onclick="alert('Fonctionnalité de réservation bientôt disponible !')">Réserver</button>
                    </form>

                    <p class="text-center text-gray-500 text-sm mt-4">Aucun montant ne vous sera débité pour le moment</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
