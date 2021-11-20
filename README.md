# Blog-demo

Een simpele demo van een blog, alles is vrij simpel gehouden en gemaakt vanaf de grond op in een korte tijd.

Deze is gemaakt op Ubuntu 18.04 met php 7.2, Symfony 5.3 en mysql 5.7. Dit project zou moeten werken op andere versies maar dat weet ik niet zeker.

<h3>Instalatie:</h3>

- Download de bestanden en plaats dezen op een locatie om te draaien.
- Instaleer Php, Symfony, Mysql en Composer.
- Importeer blog_demo.sql in mysql, standaard is de demo ingesteld om te zoeken naar de database naam "blog_demo".
- Zo nodig pas in het .env bestand, maar details in het volgende onderdeel.
- Via terminal command line navigeer naar waar de demo bestanden staan, zorg dat je in de folder ben.
- Gebruik commando "composer install" voor het instaleren van alle externe onderdelen.
- Gebruik commando "symfony server:start" om de Symfony server op te starten.
- De terminal geeft dan een bericht terug waarin het zecht naar welk adress het luisters, meestal "https://127.0.0.1:8000", gebruikt een internet browser om daar heen te gaan.
- Dat is het, alles zou nu moeten werken

<h3>Database instellingen:</h3>

Standaard is doctrine ingesteld om een lokale database te gebruiken van mysql versie 5.7, database naam "blog_demo" met username en password bijde op root. Indien deze instellen niet gebruikt kunnen worden kan je dit aanpassen het .env bestand. Op regel 31 staat de regel `DATABASE_URL="mysql://root:root@127.0.0.1:3306/blog_demo?serverVersion=5.7"` waar dit allemaal aangepast in kan worden.
- `mysql` is voor de type database die gebruikt word.
- `root:root` is voor user en password die in de database kan komen.
- `127.0.0.1:3306` is de locatie van de database.
- `blog_demo` is de naam van de database
- `serverVersion=5.7` is voor de versie van de database die gebruikt word.
