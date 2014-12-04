# Application Web: Planning
## Spécifications fonctionnelles


# Objectif

Le but de ce projet est de développer une application web gérant le planning des salles pour la répartition des cours au CFA INSTA.

Ce planning se décompose lui-même en plusieurs plannings:

- Un planning de synthèse: qui indique uniquement la présence ou non des élèves d'une seule promotion au CFA. S'ils n'y sont pas, ils sont alors présents en entreprise
- Un planning mensuel: qui indique la présence des élèves de toutes les promotions au CFA. S'ils n'y sont pas, ils sont alors présents en entreprise
- Un planning détaillé: qui indique pour chaque date de formation :
  - La date 
  - L'intitulé du cours
  - La durée du cours (en heure ou en demi-journée) pour chaque séance
  - Le lieu (Parmentier, Jussieu, autres)
  - La ou les Salle(s)
  - Le ou les Professeur(s) – un prof principal et un prof assistant

La fonctionnalité principale de cette application est la gestion de répartition des promotions dans les salles.

# Fonctionnalités

## Fonctionnalités principales

L'outil doit pouvoir recenser: les professeurs (…), les sites (…), les salles (…), les horaires (…), les promos, les jours fériés, les vacances scolaires, les soutenances, etc…

En fonction de ces différents paramètres, l'outil doit pouvoir planifier les différentes sessions de formation et entre autre leur périodicité.

L'outil doit être capable de gérer les conflits relatifs aux :

- site (deux séances successives ne peuvent pas se dérouler sur deux sites éloignés)
- occupations de salles (deux cours dans une même salle)
- capacité des salles (le nombre d'élèves dans une promo doit être inférieur au nombre de sièges dans une salle)
- ordinateurs (on doit avoir plus de PC que d'élèves)
- charges des professeurs (on ne peut pas avoir un professeur sur deux sites ou dans deux salles, …)

## Formation

Une formation peut être visible par n'importe qui, mais ne peut cependant être créée/modifiée que par un membre de l'administration.

Pour qu'elle soit valide, un professeur doit en être le responsable.

Ledit professeur dispose alors des droits d'éditions de ladite formation, disponible via un formulaire.

## Promotion

Une promotion peut être visible par n'importe qui, mais ne peut cependant être créée/modifiée que par un membre de l'administration.

Pour qu'elle soit valide, elle doit être nommée et disposer d'une année de début de formation et d'une année de fin de formation.

## Utilisateur

Un utilisateur peut être visible par n'importe qui, il ne peut cependant être créé/modifié que par un membre de l'administration via un formulaire simple.

Pour qu'il soit valide il doit avoir un nom, un prénom, une adresse mail, et un type (Administration, Professeur ou Etudiant).

## Site

Un site peut être visible par n'importe qui, il ne peut cependant être créé/modifié que par un membre de l'administration via un formulaire simple.

Pour qu'il soit valide, la désignation, les différents champs de l'adresse postale et le numéro de téléphone doivent être renseignés.

## Salle

Une salle peut être visible par n'importe qui, elle ne peut cependant être créée/modifiée que par un membre de l'administration via un formulaire simple.

Pour qu'elle soit valide, la désignation doit être renseignée et un site y être affecté.

## Cours

Un cours peut être visible par n'importe qui, il ne peut cependant être créé/modifié que par un membre de l'administration.

Pour qu'il soit valide, il faut l'affecter à une salle, lui affecter une formation, et une promotion. Un avertissement s'affiche si la salle, le professeur de la formation ou la promotion sont déjà affectés au même horaire. Cette création se fait via un formulaire.

## Planning

Cette catégorie contient toutes les fonctionnalités des différents plannings.

### Filtre

Le planning peut être filtré, c'est-à-dire qu'il y a la possibilité d'afficher le planning d'une seule promotion ou plusieurs promotions et/ou par jour/semaine/mois.

### Journée

En face de chaque jour est affichée la date et les promotions présentes ce jour; au clic sur la promotion un détail de la journée pour ladite promotion est affiché, présentant la répartition du ou des cours pour cette promotion ce jour, l'affichage du cours présente la salle, le site, le professeur et l'intitulé de la formation; au clic sur le cours, l'utilisateur est redirigé vers le détail de ce cours ou de la formation.

Si le planning concerne une promotion en particulier, l'affichage des promotions n'est pas présent, et au clic sur la journée le détail de cette dernière est affiché, présentant la répartition du ou des cours pour cette promotion ce jour, l'affichage du cours présente la salle, le site, le professeur et l'intitulé de la formation; au clic sur le cours, l'utilisateur est redirigé vers le détail de ce cours ou de la formation.

### Recherche

Dans un champs texte se situant au-dessus du planning, il a la possibilité de rechercher des cours ou des formations en tapant leur intitulé et en soumettant le formulaire.

## Partie administration

Dans la partie administration se fait la gestion des utilisateurs: ajout, modification, suppression. Ainsi que la gestion de leurs droits.

De plus des liens sont disponibles vers les formulaires d'ajout et de modification des salles, des sites, des professeurs, des formations, des promotions et des cours.