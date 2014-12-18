Manuel d'instalation
===

1. Importez ce projet dans votre dossier web de votre serveur

En ligne de commande : 
---

2. Placez vous dans le dossier du projet et installez les composants avec la commande `php composer.phar install`
3. Configurez votre base de données avec le fichier `app/config/parameters.yml`
4. Mettez à jour le schéma de votre base avec la commande `php app/console doctrine:schema:update --force`
5. Installez les assets avec la commande `php app/console assets:install`
6. Insérez un nouvel utilisateur avec la commande `php app/console fos:user:create --super-admin`, suivez les instructions pour insérer le premier utilisateur en tant qu'administrateur de l'application

Vous pouvez désormais acceder à votre application, et ajouter des utilisateurs, des groupes, etc.
