![logo](logo.svg)

Jeunes 6.4 est le projet d'informatique de Pré Ing 2 de l'année 2022-2023 de CY Tech.

## Consignes

L'énoncé est disponible [ici](énoncé.pdf)

## Installation

### Installer PHP Composer

PHP composer est l'outil qui permet d'installer les dépendances du projet.

Si vous avez déjà Composer installé sur votre système, vous pouvez passer cette étape.

Sur Linux :

```shell
sudo apt install -y php php-xml php-sqlite3 php-curl php-zip php-dompdf 
```

### Installer les dépendances du projet

Le projet est basé sur le framework Laravel. Pour l'installer avec ses dépendances il faut exécuter la commande
suivante :

```shell
php composer install
```

### Environnement

Le projet dépend de variables stockées dans le fichier `.env`.

La configuration par défaut ce situe dans le fichier `.env.example`.
Vous pouvez le renommer en `.env` pour l'utiliser.

Une base de données par défaut est aussi fournie.

Le projet est maintenant prêt à être utilisé.

### Migrer la base de données

Pour remplir la base de données avec les bonnes tables, vous devez utiliser la commande suivante :

```shell
php artisan migrate:fresh
```

## Lancer le serveur

Vous pouvez lancer le serveur via la commande :

```shell
php artisan serve
```

Et naviguer vers l'URL https://127.0.0.1:8000/.

## Tester le projet

Le projet est fourni avec des tests qui permettent de s'assurer de son intégrité et d'éviter toute récession lors du
développement.

Pour les exécuter, il faut utiliser la commande suivante :

```shell
php artisan test
```

## Commandes de debug

Quelques commandes ont été ajoutées pour aider au debugging lors de la phase de développement :

- `php artisan user:register`: Enregistre un utilisateur manuellement
- `php artisan mail:send`: Envoie un mail à l'adresse donnée.

Exécuter une de ses commandes sans argument affichera la syntaxe exacte.

## Architecture du projet

Le projet utilise Laravel. Laravel est un framework en PHP qui offre gère à notre place de nombreux aspects techniques
du projet :

- Gestion des routes
- Gestion de l'authentification/de la session
- Interactions avec la base de données grâce à l'ORM Eloquent
- Envoi de mails
- Tests grâce à PHPUnit
- SSR grâce à Blade

### Front-end

Le front-end du projet est fait avec le trio HTML/CSS/JS et Blade. Blade est une bibliothèque qui permet de générer du
HTML côté serveur via des directives et du code en PHP.

Voici à titre d'exemple la partie front-end du système de notification d'erreurs :

```php
@foreach($errors->all() as $error)
    <div class="notif error">
        <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
        <p>{{$error}}</p>
    </div>
@endforeach
```

### Back-end

Le back-end du projet est fait en PHP avec Laravel. Il suit la même architecture que leur projet minimal sur Github.
Grâce à l'abstraction technique proposée par Laravel, nous avons pû nous concentrer sur la logique métier du site et
avancer efficacement.
