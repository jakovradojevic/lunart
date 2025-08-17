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
