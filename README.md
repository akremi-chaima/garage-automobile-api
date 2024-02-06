# GarageAutomobileAPI
## Installation
- Installer Docker: https://docs.docker.com/engine/install/
## Comment lancer le projet en local

- À la racine du projet:
  - Exécuter la command `docker network create apis` pour créer un pont de communication entre les conteneurs PHP, NGINX et MYSQL
  - Exécuter la commande `docker-compose up -d` pour créer les conteneurs
  - Exécuter la commande `docker ps` pour vérifier si on a bien les 3 conteneurs
  

    ![ScreenShot](./readme/containers.png)
  
  
  - Exécuter la commande `docker compose run php composer install` pour installer les librairies
  - Créer les tables 
    - Soit exécuter la commande `docker compose run php bin/console doctrine:schema:update --force` pour créer les tables à partir les entités
    - Soit exécuter la commande `docker compose run php bin/console doctrine:migrations:migrate` pour créer les tables à partir les migrations 
  - Initialiser la base de données `docker compose run php bin/console doctrine:fixtures:load -q`
- Accéder à l'API doc:
  - En local: http://0.0.0.0:8080/api/doc
  - Sur le serveur: https://garage-automobile-api.chaimaakremi.com/api/doc


  ![ScreenShot](./readme/api_doc.png)

  
- Se connecter à la BDD en local:
  - Host: `localhost`
  - User: `myUser`
  - Password: `myPassword`
  - BDD name: `garage-automobile`


  ![ScreenShot](./readme/bdd_connexion.png)


- Tester l'authentification:
  - Admin:
    - Url: `http://0.0.0.0:8080/api/login`
    - Email: `chaima.akremi.1997@gmail.com`
    - Password: `myPassword`
  - Employé:
    - Url: `http://0.0.0.0:8080/api/login`
    - Email: `chaima.akremi@gmail.com`
    - Password: `myPassword`


  ![ScreenShot](./readme/authentification.png)


- Récupérer la liste des users par l'administrateur en utilisant le token
  `curl --location '0.0.0.0:8080/api/private/users' \
  --header 'Authorization: Bearer REMPLACER_PAR_ADMIN_TOKEN'`


  ![ScreenShot](./readme/users_list.png)

