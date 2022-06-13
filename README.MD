# ArticlesApi

## Sujet

Développer une petite application web qui permet de gérer des articles à partir d’une API.
Il faut s’imaginer que c’est le début d’une grosse application qui sera amenée à évoluer.
Chaque élément doit être pensé pour pouvoir évoluer, être maintenu facilement et être performant.

## Setup

Pour faire fonctionner l'application, suivez les étapes suivantes :

**Installation des dépendances de Composer**

Assurez-vous que vous avez installé [Composer](https://getcomposer.org/download/).
Puis exécutez :

```
composer install
```

**Configuration de la base de données**

Tout d'abord, assurez-vous que vous avez [Docker installé](https://docs.docker.com/get-docker/)
et qu'il fonctionne. Pour démarrer le conteneur, exécutez :

```
docker-compose up -d
```

Ensuite, il faut construire la base de données, exécuter les migrations et charger les fixtures avec :

```
# "symfony console" is equivalent to "bin/console"
# but its aware of your database container
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
```

Le binaire `symfony` peut être téléchargé à partir de https://symfony.com/download.

**Démarrer le serveur web Symfony**.

Vous pouvez utiliser Nginx ou Apache, mais le serveur web local de Symfony
est ma solution recommandée.

Pour installer le serveur web local de Symfony, suivez les instructions suivantes
les instructions "Télécharger le client Symfony" trouvées
ici : https://symfony.com/download - vous n'avez besoin de faire cela qu'une seule fois
une seule fois sur votre système.

Ensuite, pour démarrer le serveur web, ouvrez un terminal, allez dans le projet
et exécutez :

```
symfony serve
```

(Si c'est la première fois que vous utilisez cette commande, vous pouvez voir une
erreur indiquant que vous devez d'abord exécuter `symfony server:ca:install`).

Maintenant accédez au site à `https://localhost:8000`
