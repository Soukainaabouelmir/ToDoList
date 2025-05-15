<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoList Pro - Gérez vos tâches efficacement</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #333;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            text-align: center;
        }
        
        .hero {
            margin-bottom: 40px;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: 700;
        }
        
        .subtitle {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 30px;
            max-width: 700px;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(45deg, #34badb, #19ddc1);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
            margin-top: 20px;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.6);
        }
        
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
        }
        
        .feature-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            width: 250px;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #3498db;
        }
        
        .feature-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .feature-desc {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        .screenshot {
            margin: 50px 0;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            max-width: 100%;
            height: auto;
            border: 10px solid white;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            .features {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>Organisez votre vie avec TodoList 3IA</h1>
            <p class="subtitle">
                La solution ultime pour gérer vos tâches quotidiennes, projets et objectifs. 
                Simple, intuitive et puissante - tout ce dont vous avez besoin pour rester productif.
            </p>
            <a href="{{ route('login') }}" class="cta-button">Commencer maintenant</a>
        </div>
        
       
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3 class="feature-title">Gestion simple</h3>
                <p class="feature-desc">Créez, organisez et suivez vos tâches en quelques clics seulement.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">⏱️</div>
                <h3 class="feature-title">Rappels intelligents</h3>
                <p class="feature-desc">Ne ratez plus jamais une échéance avec nos rappels personnalisés.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Statistiques</h3>
                <p class="feature-desc">Visualisez votre productivité avec des graphiques et analyses.</p>
            </div>
        </div>
    </div>
</body>
</html>