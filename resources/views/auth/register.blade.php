<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Mini-Rb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex justify-center items-center space-x-2 text-rose-500 mb-6 hover:text-rose-600 transition">
            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-current"><path d="M16 1c2.008 0 3.463.963 4.751 3.269l.533 1.025c1.954 3.83 6.114 12.54 7.1 14.836l.145.353c.667 1.591.91 2.472.96 3.396l.01.415v.301c0 4.262-2.87 7.405-6.66 7.405-2.008 0-3.463-.963-4.751-3.269l-.533-1.025c-1.954-3.83-6.114-12.54-7.1-14.836l-.145-.353c-.667-1.591-.91-2.472-.96-3.396l-.01-.415v-.301c0-4.262 2.87-7.405 6.66-7.405zm0 2.249c-2.316 0-3.969 1.942-3.969 4.407 0 .793.183 1.54.526 2.366l.135.293c.895 1.91 4.708 9.814 6.69 13.82l.533 1.025c1.025 1.91 1.761 2.41 2.41 2.41.648 0 1.384-.5 2.41-2.41l.533-1.025c1.982-4.006 5.795-11.91 6.69-13.82l.135-.293c.343-.826.526-1.573.526-2.366 0-2.465-1.653-4.407-3.969-4.407-1.353 0-2.355.672-3.327 2.41l-.533 1.025c-1.606 3.104-4.802 9.537-6.31 12.607l-.145.31c-.512 1.03-.895 1.488-1.255 1.488-.36 0-.743-.458-1.255-1.488l-.145-.31c-1.508-3.07-4.704-9.503-6.31-12.607l-.533-1.025c-.972-1.738-1.974-2.41-3.327-2.41zm0 7.842c.648 0 1.384.5 2.41 2.41l.533 1.025c1.606 3.104 4.802 9.537 6.31 12.607l.145.31c.512 1.03.895 1.488 1.255 1.488.36 0 .743-.458 1.255-1.488l.145-.31c1.508-3.07 4.704-9.503 6.31-12.607l.533-1.025c1.025-1.91 1.761-2.41 2.41-2.41s1.384.5 2.41 2.41l.533 1.025c1.982 4.006 5.795 11.91 6.69 13.82l.135.293c.343.826.526 1.573.526 2.366 0 2.465-1.653 4.407-3.969 4.407-2.316 0-3.969-1.942-3.969-4.407 0-.793.183-1.54.526-2.366l.135-.293c.895-1.91 4.708-9.814 6.69-13.82l.533-1.025c1.025-1.91 1.761-2.41 2.41-2.41z"></path></svg>
            <span class="font-bold text-3xl tracking-tighter">Mini-Rb</span>
        </a>

        <h3 class="text-xl mb-4 text-center">Créer un compte</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nom</label>
                <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500" required>
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2 text-center">Choisir votre rôle</label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="voyageur" class="peer hidden" checked>
                        <div class="p-2 text-center border rounded-lg peer-checked:border-rose-500 peer-checked:bg-rose-50 hover:bg-gray-50 transition text-sm">Voyageur</div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="hote" class="peer hidden">
                        <div class="p-2 text-center border rounded-lg peer-checked:border-rose-500 peer-checked:bg-rose-50 hover:bg-gray-50 transition text-sm">Hôte</div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="admin" class="peer hidden">
                        <div class="p-2 text-center border rounded-lg peer-checked:border-rose-500 peer-checked:bg-rose-50 hover:bg-gray-50 transition text-sm">Admin</div>
                    </label>
                </div>
                @error('role') <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500" required>
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Mot de passe</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500" required>
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500" required>
            </div>
            <button type="submit" class="w-full bg-rose-500 text-white py-2 rounded-lg font-semibold hover:bg-rose-600 transition">S'inscrire</button>
        </form>
        <p class="mt-4 text-center text-sm">Déjà un compte ? <a href="{{ route('login') }}" class="text-rose-500">Se connecter</a></p>
    </div>
</body>
</html>
