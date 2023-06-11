![logo](logo.svg)

Jeunes 6.4 est le projet d'informatique de Pré Ing 2 de l'année 2022-2023 de CY Tech.

## Consignes

L'énoncé est disponible [ici](énoncé.pdf).

## Installation

### Installer les dépendances de Composer

Si vous avez déjà Composer installé sur votre système, vous pouvez passer cette étape, car vous avez déjà les dépendances nécessaires.

Composer est l'outil qui permet d'installer les dépendances du projet.
Il est actuellement fourni avec celui-ci.

Néanmoins, pour fonctionner sur votre ordinateur, Composer nécessite certaines dépendances lui-même.

Pour les installer sous Ubuntu, il faut exécuter :

```shell
sudo apt install -y php php-xml php-sqlite3 php-curl php-zip php-dompdf 
```

### Installer les dépendances du projet

Le projet est basé sur le framework Laravel. Pour l'installer avec ses dépendances, il faut exécuter la commande
suivante :

```shell
php composer install
```

### Environnement

Le projet dépend de variables stockées dans le fichier `.env`.

La configuration par défaut ce situe dans le fichier `.env.example`.
Vous pouvez le copier/coller ou le renommer en `.env` pour l'utiliser.

Une base de données par défaut est aussi fournie.

Le projet est maintenant prêt à être utilisé.

### (Optionnel) Migrer la base de données

En cas de problème, vous pouvez réinitialiser la base de données avec les bonnes tables.
Il suffit de se servir de la commande suivante :

```shell
php artisan migrate:fresh
```

## Lancer le serveur


### Mode local (*127.0.0.1* ou *localhost* )
Vous pouvez lancer le serveur via la commande :

```shell
php artisan serve
```

Vous pourrez alors retrouver l'interface du projet à l'adresse http://127.0.0.1:8000/.

### Mode réseau
La commande, très similaire, devient :

```shell
php artisan serve --host 0.0.0.0 --port=8000
```

Il faut ensuite remplacer dans le navigateur la partie *127.0.0.1* de l'adresse précédent par l'adresse IP (locale ou public) ou le nom de domaine du serveur.

Pensez à ouvrir une redirection de port pour les échanges réseaux via Internet. Un pare-feu peut également bloquer le bon fonctionnement du projet, il est donc important de vérifier ses paramètres.

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

Exécuter une de ces commandes sans arguments affichera la syntaxe exacte à utiliser.

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

```blade
@foreach($errors->all() as $error)
    <div class="notif error">
        <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
        <p>{{$error}}</p>
    </div>
@endforeach
```

### Back-end

Le back-end du projet est fait en PHP avec Laravel. Il suit la même architecture que leur projet minimal sur GitHub.
Grâce à l'abstraction technique proposée par Laravel, nous avons pu nous concentrer sur la logique métier du site et
avancer efficacement.
