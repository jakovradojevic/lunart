# LUNART WordPress Theme

Profesionalna WordPress tema za konzervaciju i restauraciju umetničkih dela.

## Funkcionalnosti

### 🎨 Demo Content Importer
- **Stranice**: Početna, O nama, Usluge, Kontakt, Blog
- **Blog postovi**: 10 demo članaka sa kategorijama i tagovima
- **Usluge**: 8 demo usluga kao Custom Post Type
- **Navigacija**: Glavni i footer meni
- **Footer**: Poslovni podaci na latinici
- **Kategorije i tagovi**: Predefinisane kategorije za blog

### 🔧 Logo Management
- Opcije za sliku ili tekst logo
- Prilagodljiva tipografija
- Kontrola poravnanja i razmaka
- Admin stranica za upravljanje logom

### 📱 Responsive Design
- Mobilno prilagođen dizajn
- Dinamička navigacija
- Optimizovane slike

## Instalacija

1. **Upload tema** u `wp-content/themes/` direktorijum
2. **Aktiviraj temu** kroz WordPress admin panel
3. **Import demo sadržaja** kroz Tools > Demo Content Importer

## Korišćenje Demo Importer-a

### Korak 1: Pristup Demo Importer-u
- Idite na **Tools > Demo Content Importer** u WordPress admin panelu

### Korak 2: Izbor sadržaja
- **Content**: Stranice, postovi, usluge, kategorije, tagovi, media, meni
- **Customization**: Widgets, customizer postavke
- **Advanced**: Overwrite existing content, attachments, footer business data

### Korak 3: Import
- Kliknite **Start Import** dugme
- Pratite progres kroz progress bar
- Sačekajte da se import završi

## Struktura Demo Sadržaja

### Stranice
- **Početna** (`front-page.php`): Hero sekcija, o nama, usluge, blog, kontakt
- **O nama**: Informacije o kompaniji
- **Usluge**: Pregled svih usluga
- **Kontakt**: Kontakt forma i informacije
- **Blog**: Stranica za blog postove

### Blog Postovi (10)
- **Kategorije**: Konzervacija, Restauracija, Saveti
- **Tagovi**: konzervacija, restauracija, umetnost, slika, dokument, tekstil, keramika, metal, drvo
- **Sadržaj**: Stručni članci o konzervaciji i restauraciji

### Usluge (Custom Post Type)
1. Konzervacija umetničkih dela
2. Restauracija slika
3. Restauracija dokumenata
4. Restauracija tekstila
5. Restauracija keramike
6. Restauracija metala
7. Restauracija drveta
8. Preventivna konzervacija

### Footer Business Data
- **Naziv**: LUNART
- **Poslovno ime**: Mila Borak preduzetnik Umetničko stvaralaštvo Lunart Beograd-Zvezdara
- **Status**: Aktivan
- **Pravna forma**: Preduzetnik
- **Matični broj**: 68039665
- **Datum osnivanja**: 20.05.2025.
- **Šifra delatnosti**: 9003
- **Opis delatnosti**: Umetničko stvaralaštvo
- **PIB**: 115033613
- **Broj tekućeg računa**: 265-1630310011591-68

## Logo Management

### Customizer Opcije
- **Logo Type**: Image ili Text
- **Logo Image**: Upload slike za logo
- **Logo Text**: Tekstualni logo
- **Logo Subtitle**: Podnaslov loga
- **Typography**: Font, veličina, boja
- **Alignment**: Poravnanje (levo, centar, desno)
- **Spacing**: Razmaci između elemenata

### Admin Stranica
- **Appearance > Logo Options**
- Live preview funkcionalnost
- Reset opcije

## Custom Post Types

### Service CPT
- **Slug**: `service`
- **Labels**: Usluge (srpski)
- **Icon**: `dashicons-admin-tools`
- **Meta Fields**: service_icon, service_price, service_duration

## Navigacija

### Lokacije
- **Primary**: Glavni meni u header-u
- **Footer**: Footer meni

### Fallback Menu
- Automatski generisan meni ako nema kreiranih menija
- Linkovi ka demo stranicama

## Responsive Design

### Breakpoints
- **Desktop**: > 768px
- **Mobile**: ≤ 768px

### Mobile Features
- Hamburger meni
- Touch-friendly dugmad
- Optimizovane slike

## CSS Struktura

### Glavne sekcije
- `.hero-section`: Hero sekcija sa gradijentom
- `.about-section`: O nama sekcija
- `.services-section`: Grid sa uslugama
- `.blog-section**: Blog postovi
- `.contact-section`: Kontakt forma
- `.site-footer`: Footer sa poslovnim podacima

### Komponente
- `.btn`: Dugmad (primary, secondary)
- `.service-card`: Kartice usluga
- `.blog-card`: Kartice blog postova
- `.form-group`: Form elementi

## JavaScript Funkcionalnosti

### Demo Importer
- AJAX import sadržaja
- Progress bar
- Error handling
- Step-by-step import

### Mobile Menu
- Toggle funkcionalnost
- Click outside to close
- Smooth animations

## Fajl Struktura

```
lunart-wordpress-theme/
├── functions.php              # Glavne funkcije teme
├── header.php                 # Header sa navigacijom
├── footer.php                 # Footer sa poslovnim podacima
├── front-page.php            # Glavna stranica
├── style.css                 # Glavni CSS stilovi
├── js/
│   └── demo-importer.js      # Demo importer JavaScript
├── inc/
│   └── customizer.php        # Customizer opcije
└── assets/                    # Slike i media fajlovi
```

## Troubleshooting

### Česti problemi
1. **Logo se ne prikazuje**: Proverite da li je logo postavljen u Logo Options
2. **Demo import ne radi**: Proverite da li imate admin privilegije
3. **Navigacija se ne prikazuje**: Proverite da li su meniji kreirani kroz demo importer

### Debug
- Uključite `WP_DEBUG` u `wp-config.php`
- Proverite error log-ove
- Koristite browser developer tools

## Podrška

Za podršku i pitanja:
- **Email**: info@lunart.rs
- **Website**: lunart.rs

## Changelog

### v1.0.0
- Inicijalna verzija
- Demo content importer
- Logo management
- Custom post types
- Responsive design
- Footer business data

## Licenca

Ova tema je kreirana za LUNART i nije namenjena za distribuciju.


## Gde se uređuje sadržaj

Evo gde i kako sada uređujete sve delove sajta u ovoj temi:

- Početna stranica (Home)
  - Idite na Settings > Reading i izaberite „A static page“ za „Your homepage displays“.
  - Za „Homepage“ izaberite stranicu koju želite (npr. „Početna“). Uredite tu stranicu kao bilo koju drugu (Gutenberg blokovi ili Klasični editor). front-page.php prikazuje sadržaj te stranice — ceo sadržaj je editabilan direktno u editoru stranice.
  - U blok editoru otvorite „Patterns > Lunart Obrasci“ i ubacite sekcije: „Lunart Hero“, „Lunart Usluge“, „Lunart Galerija“, „Lunart O nama“, „Lunart Blog“. Sve sekcije izgledaju isto kao u demo index.php i potpuno su editabilne (tekstovi, dugmad, broj usluga/galerija preko shortcode parametara).

- Logo i naziv sajta
  - Appearance > Customize > Site Identity
  - Tu su prebačene sve „Logo Options“: tip (slika/tekst/oba), upload slike, naslov/podnaslov, tipografija, poravnanje i razmaci.
  - Renderovanje je ujednačeno: uvek postoji .lunart-logo wrapper i klase poravnanja (npr. .lunart-logo-left) i za goste i ulogovane korisnike.

- Footer (podatke, sadržaj, copyright)
  - Appearance > Widgets > Footer — ako dodate widgete u „Footer“ zonu, footer postaje potpuno editabilan kroz widgete/blok widgete.
  - Ako ne koristite widgete, prikazuje se podrazumevani footer sa poslovnim podacima i kontaktom, koje možete menjati u Customizer-u:
    - Appearance > Customize > Footer Opcije (tekst za copyright) i Lunart Kontakt/Društvene mreže (kontakt i linkovi)
  - Godina u copyrightu je dinamička. U tekstu koristite {year} ili [year] ili {{year}} — tema ih automatski menja u tekuću godinu.

- Stranice „O nama“ i „Kontakt“
  - Uredite ih standardno u Pages.
  - Demo Importer (Tools > Demo Content Importer) može da ih kreira ako ih još nemate.

- Kontakt forma (Contact Form 7)
  - Instalirajte i aktivirajte „Contact Form 7“ plugin.
  - Zatim u Tools > Demo Content Importer kliknite „Kreiraj Kontakt Formu“. Kreira se forma „Kontakt forma (Lunart)“ i shortcode se automatski dodaje na stranicu „Kontakt“ (ako postoji).

- Meniji (navigacija)
  - Appearance > Menus (ili Appearance > Customize > Menus). Lokacije: Primary (glavni meni) i Footer (footer meni).
  - Demo Importer može automatski kreirati i dodeliti menije.

- Galerija radova i Usluge (CPT)
  - Galerija: „Galerija“ (post type: gallery_item). Svaka stavka ima polja „pre/posle“ slike, kategoriju i podnaslov (meta boks „Detalji Galerije“).
  - Usluge: „Usluge“ (post type: service). Svaka usluga ima izbor ikonice/boje i dinamičke taksativne opcije (meta boks „Detalji Usluge“).
  - Demo Importer može da ubaci demo sadržaj za oba tipa.

- Društvene mreže i kontakt podaci u header/footer-u
  - Appearance > Customize > Društvene Mreže — unesite URL-ove.
  - Appearance > Customize > Kontakt Informacije — tel, email i adresa.

Napomena: Ako ste prethodno koristili stare „Logo Options“, one su sada transplantirane u Site Identity radi jednostavnijeg upravljanja na jednom mestu. Nema potrebe da ručno menjate kod; sve opcije su u Customizer-u.


## Gde smo stali / Poslednje izmene

Datum: 2025-08-20 19:34

Sažetak najskorijih izmena i na čemu smo poslednje radili:

- Logo upravljanje
  - Sve prilagođene Logo opcije su premeštene pod Appearance > Customize > Site Identity (title_tagline). Pojedinačna "Logo Options" sekcija je uklonjena.
  - Funkcija za renderovanje logotipa (lunart_get_logo_html) sada radi po prioritetu: (1) legacy logo slika ako je podešena (image/both), (2) WordPress Custom Logo (Site Identity), (3) fallback tekstualni logo (naslov/podnaslov sajta).
  - Link ka početnoj je sada deo samog logotipa u funkciji, a ne spolja u header-u.
  - Stilovi logotipa se ubacuju sa prioritetom 20 kako bi pouzdano primenili vrednosti iz Customizer-a.

- Header i Footer
  - Header: uklonjen je spoljašnji <a> oko logotipa jer ga generiše sama funkcija lunart_get_logo_html().
  - Footer: dodat je widgetizovani Footer (Appearance > Widgets > Footer). Ako dodate widgete/blokove, ceo footer je editabilan. Ako nema widgeta, prikazuje se podrazumevani footer sa poslovnim podacima i kontaktom.
  - Copyright podržava {year}, [year] ili {{year}} kao placeholder za tekuću godinu.
  - Dodata je funkcija za ispis društvenih mreža (lunart_get_social_media_html) i njena upotreba u footer-u.

- Demo Importer
  - Dodata je opcija za kreiranje Contact Form 7 forme („Kontakt forma (Lunart)“) i automatsko ubacivanje shortcode-a na stranicu „Kontakt“ (ako plugin CF7 postoji i strana postoji).

- Dokumentacija
  - README proširen sekcijom "Gde se uređuje sadržaj" sa uputstvima za Početnu stranicu, logotip, footer, menije, CPT-ove, društvene mreže i kontakt podatke.

Šta je sledeće (predlog):
- Proveriti da li su svi stari korisnički sajtovi bez Custom Logo-a i dalje pravilno prikazani zahvaljujući legacy logici (testovati image/both/text varijante). 
- Po potrebi dodati još footer widget zona (npr. Footer 2, Footer 3) i grid raspored.


## Gutenberg blokovi (Početna)

U ovoj verziji tema dobija sopstvene Gutenberg blokove koji repliciraju postojeći dizajn početne strane 1:1, ali omogućavaju potpunu editabilnost sadržaja.

Dostupni blokovi (server-side render):
- lunart/hero — naslov u dve linije, podnaslov, 2 dugmeta, 3 feature stavke (fiksne), interni CTA (naslov, opis, 2 dugmeta, info linija).
- lunart/services — dinamički prikaz „Usluga“ (CPT), sekcijski naslov/opis, limit (default 6), CTA (naslov, opis, dugme/link). Koristi postojeći lunart_get_service_icon_html i meta podatke.
- lunart/gallery — omotač oko [lunart_gallery] shortcode-a sa limit atributom; sekcijski naslov/opis i CTA blok ispod galerije.
- lunart/blog-teaser — naslov/opis, placeholder „Blog uskoro“, CTA.
- lunart/about — naslov, glavni pasus, citat + autor, CTA.
- lunart/cta — generički CTA (title, description, buttonLabel, buttonHref, styleVariant=primary|outline).

Napomene:
- Blokovi su trenutno „server-rendered“ (render_callback u PHP). Editor kontrole (Inspector Controls) i block.json biće dodati u sledećoj fazi.
- Svi podrazumevani tekstovi su identični trenutnoj početnoj (index.php) i mogu se menjati kad dodamo editor kontrole. Demo Importer već ume da ih ubaci kao sadržaj.

Demo Importer (Početna + Blog):
- Tools > Demo Content Importer > „Stranice“ sada kreira:
  - „Početna“ (slug: pocetna) sa sledećim blokovima redom: hero, services, gallery, blog-teaser, about.
  - „Blog“ (slug: blog) praznu stranicu za prikaz postova.
  - Postavlja „Početna“ kao Front Page, a „Blog“ kao Posts page (Settings > Reading opcije se automatski ažuriraju).
- „O nama“ i „Kontakt“ ostaju dostupne kao zasebne stranice (kao i ranije).

Kako koristiti:
1) Pokrenite Demo Importer i kliknite „Kreiraj Stranice“. 
2) Otvorite stranicu „Početna“ u Gutenbergu — videćete Lunart blokove. (U ovoj fazi su dinamički; ručno menjanje atributa kroz UI dolazi u sledećoj fazi.)
3) Uslugama i Galeriji upravljajte kroz odgovarajuće CPT-ove („Usluge“, „Galerija“); sadržaj se dinamički prikazuje.

Plan (sledeća faza):
- Dodati block.json i minimalan editor JS za svaki blok (Inspector Controls za sva polja) i kategoriju „Lunart Blocks“ u inserter-u.


## Kako se sada edituje?

Sve sekcije Početne su sada Gutenberg blokovi (lunart/*) sa živim pregledom i panelom „Sadržaj“ u desnoj bočnoj traci.

- Gde: Stranice > Početna > Uredi (Gutenberg)
- Kako:
  1) Kliknite na sekciju (blok) u platnu.
  2) Otvorite desni sidebar (ikona zupčanika) ako nije vidljiv.
  3) U tabu Block vidite panel „Sadržaj“ — tu menjate sva polja (naslovi, opisi, dugmad, limiti, sl.).
  4) Pregled u platnu se odmah ažurira (server-side render).

Ko se gde edituje:
- Hero (lunart/hero): naslov u 2 reda, podnaslov, 2 dugmeta, 3 feature stavke, interni CTA (naslov, opis, 2 dugmeta, info linija).
- Usluge (lunart/services): sekcijski naslov/opis i limit; kartice dolaze iz CPT „Usluge“ (Usluge > Dodaj novu). Ikonice i stavke liste dolaze iz post meta (kao i do sada).
- Galerija (lunart/gallery): naslov/opis i limit; slike dolaze iz CPT „Galerija“ preko kratkog koda [lunart_gallery].
- Blog Teaser (lunart/blog-teaser): naslov/opis + CTA; placeholder „Blog uskoro“.
- O Lunart-u (lunart/about): naslov, glavni pasus, citat i autor + CTA.
- CTA (lunart/cta): generički CTA sa varijantom stila (primary/outline).
- Footer: Appearance > Widgets > Footer — dodajte blok „Footer (Lunart)“. Tu menjate logo toggle, naslov/tagline, poslovne/poreske podatke, kontakt i prikaz društvenih mreža. Ako nema widgeta, tema prikazuje isti Footer blok sa podrazumevanim vrednostima.

Podrazumevane vrednosti (stari podaci):
- Svi Lunart blokovi već imaju podrazumevane vrednosti koje 1:1 odgovaraju staroj početnoj iz index.php (naslovi, opisi, CTA tekstovi, limiti…).
- Footer blok podrazumevano sadrži vaše stare poslovne podatke (naziv, poslovno ime, PIB, matični broj, šifra delatnosti, račun…).
- URL-ovi društvenih mreža i dalje se uzimaju iz Customizer-a: Appearance > Customize > Društvene Mreže.

Napomena:
- Demo Importer već kreira stranicu Početna sa Lunart blokovima. Ako želite sve iz početka, koristite „Uvezi SAV Sadržaj“ u Tools > Demo Content i (opciono) štiklirajte „Obriši postojeći sadržaj (potvrda)“.
