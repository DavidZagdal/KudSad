# KudSad Website

## Uvod

Ova web aplikacija je razvijena korištenjem XAMPP alata koji uključuje Apache web server i MySQL bazu podataka. Kako bismo testirali funkcionalnosti lokalno, koristili smo XAMPP okruženje prije nego što smo se odlučili na hostanje web aplikacije.

Zbog AAI@EduHr autentikacije, odlučili smo kupiti domenu kudsad.site. Nakon toga, koristimo domain.com za hosting naše web stranice. Prvo testiramo promjene lokalno, a zatim ih prenosimo na glavnu stranicu putem FTP-a.

## Sadržaj

- [about](#about)
- [erasecookies](#erasecookies)
- [font](#font)
- [help](#help)
- [homepage](#homepage)
- [images](#images)
- [login](#login)
- [odabir-fakulteta](#odabir-fakulteta)
- [posao](#posao)
- [prebacivanje-fakulteta](#prebacivanje-fakulteta)
- [setglbvar](#setglbvar)
- [svi-smjerovi](#svi-smjerovi)
- [tablicafakulteta](#tablicafakulteta)
- [toolbar](#toolbar)
- [index.php](#index.php)
- [main-css-for-pages.css](#main-css-for-pages.css)
- [style.css](#style.css)

## Detalji o različitim dijelovima aplikacije

### about

U ovoj mapi je stranica u kojoj je naveden opis web aplikacije i njenih funkcionalnosti te tima koji ju je izgradio.

Primarne tehnologije / načini korišteni:
-html
-bootstrap
-font awesome (strelice)
-php (minimalno)

### erasecookies

U ovoj mapi je stranica koja ima funkcionalnost brisanja kolačića.

Kada korisnik u toolbaru pritisne logout, onda ce se prvo ići u file erasecookie.php koji je u ovom folderu. On će izbrisati sve lokalne cookiese koje je korisnik s vremenom dobio.

Primarne tehnologije / načini korišteni:
-php

```php
    setcookie("id_smjera", "", time() - 1, "/"); //stavljanje svakog postavljenog cookiea na 1 sekundu prije nego sto istekne, brisajuci ga
```

### font

Pokušaj korištenja drugih fontova. Deprecated.

### help

Upute za korištenje aplikacije i kontakt informacije za podršku te privacy i cookie policies.

Privacy i cookie policy rađeni na Termly stranicu. Rađeni su da bi dobili od AAI@EduHr sustava potvrdu.

### homepage

Mapa početne stranice.
Na stranici prikazujemo, ako je postavljeno, fakultet i smjer korisnika, te mu dajemo opcije da odabere posao, prebacivanje smjera, ili mijenjanje odabranog smjera/fakulteta.
Svaki fakultet ima sovju web stranicu te tako pomoću iframe-a korisnik će upravo to i vidjeti.

### images

Jedina korištena slika na stranici jest logo stranice. Za ikone koristimo font-awesome.

### login

Mapa sa funkcionalnostima prijave korisnika. 
Ovdje će biti prijava za AAI@EduHr sustav kada dobijemo potvrdu korištenja. 
Trenutačno postoji login koji radi s bazom podataka, ali ne vidimo smisao proširivati taj sistem jer target audience su hrvatski studenti koji sigurno imaju AAI@EduHr korisnički račun.

### odabir-fakulteta

Mapa procesa odabira fakulteta i smjerova na web stranici.

Datoteke:
-filter.php
  -jos nije u funkciji međutim jednostavno se koristi php skripta i ispisuje samo oni koji podudaraju
-index.php
  -glavna stranica koja prikazuje tablicu svih smjerova fakulteta te opciju brisanja prošlih odabira
-izbrisiCookies.php
  -kada se na index.php stisne Reset gumb pokrenuti će se ova skripta koja će uglavnom izbrisati sve cookiese OSIM login info, koji nam koristi za verifikaciju korisnika
-saveToCookie.php
  -kada korisnik na index.php odabere opciju Spremi nakon odabira smjera, pokreće se ova skripta koja sprema cookiese id_smjera te trazi linkove za posao i linkove stranice tog fakulteta, ako već toga nema u bazi podataka
  -koristi se google search api za pronalazak i spremanje podataka linkova

Primjer veze google search API-a:
```php
  $endpoint = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$searchEngineId}&q={$encoded}";
```


### posao

Mapa koja se odnosi na poslovne ponude.
Trenutačno samo prikazuje iframe poslova s stranice fakulteta, međutim kasnijom obradom podataka će biti personalizirana lista poslova te mogućnost priakzivanje poslova od partnera koji traže kompetente studente.

### prebacivanje-fakulteta

Mapa funkcionalnosti prebacivanja smjerova na fakultetima.
Trenutačno bez funkcije.
Ideja je imati guide za svaki od 176 fakulteta, koji će opisati ukratko što napraviti ukoliko se netko želi prebaciti, te mogućnost kontakta nekog od studenta koji je već prebacio smjer u tom fakultetu (uz njihov consent).

### setglbvar

Mapa procesa postavljanja globalnih varijabli.
U ovoj mapi postavljamo session cookies koji su varijable sa podatcima za spajanje na bazu podataka.

### svi-smjerovi

Pregled svih dostupnih smjerova na fakultetima. Ne prikazuje se na stranici.

### tablica-fakulteta

Prikaz tablice sa svim fakultetima i njihovim detaljima. Ne prikazuje se na stranici.

### toolbar

Mapa s toolbarom/menu-om koje se koristi na svim stranicama.

### index.php

Glavna PHP skripta koji pokreće web aplikaciju. Šalje korisnika na php skriptu koja postavlja konekciju za bazu te ga ona šalje na homepage.
```php
  header("Location: setglbvar/setvardtb.php");.
```

### main-css-for-pages.css

Stilovi koji se koriste uglavnom kroz sve stranice.

### style.css

Dodatni stilovi za poboljšanje izgleda web stranice.
