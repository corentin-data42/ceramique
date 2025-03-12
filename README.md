Application dédiée à la céramique

Serveur:
    php-8.2-fpm 
    mariadb 11 
    nginx 1.27.4

Framework:
    Symfony 7.2

Architecture:
    DDD/Hexagonal
    CQRS

Arborescence des repertoires

\Domain => Couche Domain
    Classes Metier
\Application => Couche Application
    Cas d'usages
    Definition des ports d'interfaces 
\ =>Infrastructure
    Considerant que le FrameWork Symfony est le maitre d'oeuvre de l'infrastructure 
    je prefere ne pas modifier son arborescence d'origine
\UI => Interface Utilisateur dependante de la couche Infrastructure
