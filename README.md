Pour cet exercice, j'ai fait un environnement le plus simplifié possible avec 1 controller qui s'occupe de toutes les routes, puisque dans le visuel il n'y a que des films ce n'est pas dérangeant. 
<br>
Puisqu'il faut travailler avec une API aucune entité n'était nécessaire.
<br>
Pour le call de l'API, j'ai géré ça directement avec un service "CallApiMovie.php" qui s'occupe de tous les call vers l'API. 
<br>
Il est géré avec une private Key, renseigné dans le '.env' puis fournit via le "service.yaml" pour être réutilisé par la suite dans le service. 
<br>
Concernant le DRY, il est implémenté avec la modale qui s'ouvre et s'auto-incrémente via un Call Ajax vers la route 'movie_information' ou '/search' qui renvoie les informations nécessaires en JSON pour être remplacé en front avec JS.
<br>
Le template est simple et utilisé via un parent 'base.html.twig' et twig qui l'extends, avec de l'utilisation de Bootstrap et d'un CSS 'index.css'. 
<br>