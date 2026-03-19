<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; padding: 40px; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { color: #f43f5e; font-size: 28px; font-weight: bold; }
        .btn { display: inline-block; background: #f43f5e; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; }
        .footer { text-align: center; color: #999; font-size: 12px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Mini-Rb</div>
        </div>

        <h2>🎉 Bienvenue sur Mini-Rb !</h2>
        <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
        <p>Nous sommes ravis de vous accueillir sur <strong>Mini-Rb</strong>, la plateforme de location de logements entre particuliers.</p>

        @if($user->role === 'hote')
            <p>En tant qu'<strong>hôte</strong>, vous pouvez dès maintenant publier vos annonces et accueillir des voyageurs du monde entier.</p>
        @elseif($user->role === 'voyageur')
            <p>En tant que <strong>voyageur</strong>, vous pouvez parcourir des milliers de logements et réserver votre prochain séjour.</p>
        @endif

        <br>
        <a href="{{ config('app.url') }}" class="btn">Découvrir Mini-Rb</a>

        <div class="footer">
            <p>&copy; 2026 Mini-Rb. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>