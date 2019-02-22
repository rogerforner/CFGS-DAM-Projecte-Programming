> Projecte - Cicle Formatiu de Grau Superior de Desenvolupament d'Aplicacions Multiplataforma (DAM)

**Taula de continguts**

- [Què és?](#que-es)
	- [Enllaços d'interès](#enllacos-dinteres)
- [Qui?](#qui)
- [Laravel](#laravel)
- [Vue](#vue)
	- [Descarregar](#descarregar)
	- [Instal·lació](#instal-lacio)
	- [Configuració](#configuracio)
		- [.env](#env)
		- [Key](#key)
		- [Passport](#passport)
		- [Migracions (DB)](#migracions-db)
		- [Enviament de correus electrònics](#enviament-de-correus-electronics)
	- [Assets](#assets)
	- [Servidor](#servidor)
- [Recursos emprats](#recursos-emprats)
	- [Laravel](#laravel)
	- [CSS i Fonts](#css-i-fonts)
	- [JavaScript](#javascript)
	- [Tercers](#tercers)

# Què és?

**Programming Package** és el projecte final del Cicle Formatiu de Grau Superior de _Desenvolupament d'Aplicacions Multiplataforma (DAM)_, de l'[Institut de l'Ebre](https://www.iesebre.com/) (Tortosa - Terres de l'Ebre).

Aquest és un paquet que es pot veure implementat en aquest mateix repositori **Programming**.

## Enllaços d'interès

- [Projecte de la presentació](https://github.com/rogerforner/CFGS-DAM-Projecte-Programming-Presentacio)
- [Projecte final](https://github.com/rogerforner/CFGS-DAM-Projecte-Programming-Package)

---

- [Landing](https://rogerforner.github.io/CFGS-DAM-Projecte-Programming-Presentacio/)
- [Veure la presentació](https://rogerforner.github.io/CFGS-DAM-Projecte-Programming-Presentacio/presentation/index.html)
- [Veure la documentació (paquet)](https://rogerforner.github.io/CFGS-DAM-Projecte-Programming-Package/)

# Qui?

Alumne:
- [Roger Forner Fabre](https://rogerforner.com)

Professors:
- Gonçal Verge Arnau
- Jaume Ramos Prades
- Javier Sancho Fabregat
- Quique Lorente Fuertes
- Santiago Sabaté Sanz
- Sergi Tur Badenas

# Laravel

El back-end del projecte és duu a terme mitjançant el framework PHP [Laravel](https://laravel.com/).

# Vue

El front-end del projecte és duu a terme mitjançant el framework progressiu de JavaScript [Vue](https://vuejs.org/).

## Descarregar

Pots descarregar el projecte des del repositori del GitHub escribint la següent comanda en la terminal.

```
$ git clone https://github.com/rogerforner/programming.git
```

_És necessari tenir instal·lat [git](https://git-scm.com/)._

## Instal·lació

Un cop descarregat hem d'accedir al directori del projecte i instal·lar les dependències mitjançant **composer** i, també, **npm**.

```
$ composer install && npm install
```

_És necessari tenir instal·lat [composer](https://getcomposer.org/) i [npm](https://www.npmjs.com/get-npm)._

## Configuració

### .env

Un cop instal·lades les dependències copiarem el fitxer _.env.example_ i el renombrarem a **.env**.

```
$ cp .env.example .env
```

### Key

Per poder executar sense problemes l'aplicació web hem de generar una _key_. En farem servir la següent comanda artisan.

```
$ php artisan key:generate
```

### Passport

Per poder ser autenticats i dur accions a través de la API hem de generar els tokens mitjançant [Passport](https://laravel.com/docs/5.6/passport)

```
$ php artisan passport:install
```

### Migracions (DB)

Crearem una base de dades mitjançant el gestor que es disposi. Aquesta pot tenir el nom que sigui, per exemple, la podem anomenar _programming_.

Un cop tinguem la base de dades creada, ens dirigirem al fitxer _.env_ i hi escriurem el nom d'aquesta, l'usuari que hi accedeix i la seva clau.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=programming
DB_USERNAME=root
DB_PASSWORD=root
```

_Depenent del projecte, es poden emplenar la resta de paràmetres de configuració, inclòs crear-ne de nous._

Un cop configurada la base de dades hem de dur endavant les migracions. Amb aquestes es crearan les taules.

```
$ php artisan migrate
```

### Enviament de correus electrònics

Per permetre l'enviament de correus electrònics, per posar-ne un exemple, per al registre d'usuaris/ies (verificació de email), és necessari disposar d'un compte [Mailtrap](https://mailtrap.io), [Mailgun](https://www.mailgun.com/), [Gmail](https://www.google.com/gmail/), etc. i emplenar les dades del següent apartat del _.env_.

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

_Depenent del projecte, es poden emplenar la resta de paràmetres de configuració, inclòs crear-ne de nous._

## Assets

En el nostre projecte treballem amb fitxers JavaScript i SASS. Cada cop que en fem algun canvi, en aquests, s'ha de dur endavant alguna de les següents comandes per tal de que siguin efectius.

- Executar cada cop que es realitzin canvis.
```
$ npm run dev
```
- Deixar executant-se sense la preocupació d'haver-ho de fer nosaltres cada cop que realitzem algun canvi.
```
$ npm run watch
```
- Preparar els _assets_ per a producció (minificació).
```
$ npm run production
```

## Servidor

Si emprem _[Laragon](https://laragon.org/)_ no és necessari dur a terme la següent comanda, en cas contrari sí, doncs les vistes han de ser compilades i enviades a _/public_.

```
$ php artisan serve
```

_És important no aturar el servidor mentre es treballi amb l'aplicació web ja que, llavors, no visualitzariem els canvis que es realitzin en el front-end._

# Recursos emprats

## Laravel

Laravel és un framework PHP.

- [Programming Package](https://github.com/rogerforner/programming-package)
- [API Authentication (Passport)](https://laravel.com/docs/5.6/passport)
- [Laravel Socialite](https://laravel.com/docs/5.6/socialite)
- [Spatie Laravel Permission](https://github.com/spatie/laravel-permission#installation)

## CSS i Fonts

- [Bootstrap](https://getbootstrap.com/) (framework CSS)
- [Font Awesome](https://fontawesome.com/)

## JavaScript

- [Toastr](https://github.com/CodeSeven/toastr)
- [Vue.js](https://vuejs.org/)
- [axios](https://github.com/axios/axios)
- [jQuery](https://jquery.com/)

## Tercers

- [GitHub](https://github.com/)
- [GitHub Pages](https://pages.github.com/)
