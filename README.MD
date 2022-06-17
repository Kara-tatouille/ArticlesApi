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

**Génération des clés SSL**

```
symfony console lexik:jwt:generate-keypair
```

`openssl` est requis pour générer ces clés.
Vous pouvez l'installer avec `choco install openssl` sur windows
ou bien `brew install openssl` sur mac

Les clés seront sauvegardées dans `config/jwt/private.pem` et `config/jwt/public.pem`

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

## API et Documentation Swagger

**documentation Swagger**

Une documentation Swagger est générée automatiquement par le bundle API-Platform.
Cette documentation est disponible à l'adresse https://localhost:8000/api

**json+ld**

L'API utilise par défaut le format `json+ld`, un format analogue au format `json`
 lui ajoutant des méta-données utiles pour l'exploration des endpoints.
Le format `json` classique est également disponible lorsqu'il est demandé
par le header `accept` ou lorsqu'il est spécifié dans l'url 
`https://127.0.0.1:8000/api/articles.json?page=1`

**Données de base**

Lors de la création de la base de donnée, 2 utilisateurs, les status et un 
article de test sont générés.

## Authentification

Tous les endpoints requiert une connexion pour y accéder.
Pour récupérer un token de connexion, une requête POST à l'URI `/authentication_token`
est nécessaire. Plus d'informations sur cette requête sont disponibles dans
la documentation swagger accessible à l'URI `/api`

2 utilisateurs sont générés à la création de la base de donnée,
il n'est pas possible de créer ou de modifier un utilisateur via l'API.
Voici leurs informations de connexion à utiliser pour générer un token JWT :
```json
{
  "email": "jhondoe@example.com",
  "password": "1234"
}
```
```json
{
  "email": "test@example.com",
  "password": "foo"
}
```

Une fois ce token récupéré, il est nécessaire de l'ajouter au header "Authorization"

Exemple avec curl :
```bash
curl -X 'GET' \
  'https://127.0.0.1:8000/api/articles?page=1' \
  -H 'accept: application/ld+json' \
  -H 'Authorization: BEARER eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTU0NTYwNzcsImV4cCI6MTY1NTQ1OTY3Nywicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoidGVzdEBleGFtcGxlLmNvbSJ9.O0K5iQ6b9i6fC7INTVaP6rahJH90kTCrFXBreI1EQM_15FwcWR38JE3dc2-kdiG47N7Ix71YGQ7cXI5UW7n2PP_rtoljW1rUL3-IUeem6Ghn3_dCngup7lY0CoZD0Vy5HoHangMC7tSWTXpStOXLI2_jxNTiMG2z7MhnpHqpq0QlojJfcl2mpv7CRMtj8UZZFq-8oYG9HfL5EzPBPAqk7h1BooWRTJKAzjp24HmxUjaurYIgflXTU9bLZmZq0VIGN28NN4X7hX4099KSlYVGfvol-svO7zvO9MS8BnDFS8IGRmBFpvHNC-QVpK611TdV5r0sA1yyMvPCcufiCMB_wA'
```

Depuis la documentation swagger, un bouton "Authorize 🔒" est présent pour
ajouter de manière automatique ce token à toutes les requêtes.

![](https://i.imgur.com/gPx4LfR.png)
