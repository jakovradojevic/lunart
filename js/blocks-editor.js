(function(wp){
    if (!wp || !wp.blocks) { return; }
    var el = wp.element.createElement;
    var __ = wp.i18n.__;

    function serverRenderedPlaceholder(title) {
        return function(){
            return el('div', { className: 'lunart-block-editor-placeholder' }, title + ' — ' + __('server rendered', 'lunart'));
        };
    }

    // Ensure a custom category exists
    try {
        var cats = wp.blocks.getCategories();
        var hasLunart = cats && cats.some(function(c){ return c.slug === 'lunart'; });
        if (!hasLunart) {
            var newCats = (cats || []).concat([{ slug: 'lunart', title: __('Lunart Blocks', 'lunart'), icon: 'art' }]);
            if (wp.blocks.setCategories) {
                wp.blocks.setCategories(newCats);
            }
        }
    } catch(e) {}

    // Attribute maps mirroring PHP registration
    var ATTR = {
        'lunart/hero': {
            titleLine1: { type: 'string', default: 'Čuvamo Umetnost' },
            titleLine2: { type: 'string', default: 'za Buduće Generacije' },
            subtitle: { type: 'string', default: 'Stručna konzervacija i restauracija umetničkih dela na papiru - crteža, akvarela, knjiga i plakata sa preciznošću i posvećenošću očuvanju kulturnog nasleđa.' },
            primaryBtnLabel: { type: 'string', default: 'Pogledajte Naše Radove' },
            primaryBtnAnchor: { type: 'string', default: '#gallery' },
            secondaryBtnLabel: { type: 'string', default: 'Saznajte o Konzervaciji' },
            secondaryBtnHref: { type: 'string', default: '#services' },
            feature1Title: { type: 'string', default: 'Restauracija Akvarela' },
            feature1Desc: { type: 'string', default: 'Delikatan tretman akvarelnih slika i ilustracija sa očuvanjem originalnih boja i tekstura' },
            feature2Title: { type: 'string', default: 'Konzervacija Knjiga' },
            feature2Desc: { type: 'string', default: 'Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata' },
            feature3Title: { type: 'string', default: 'Crteži i Grafike' },
            feature3Desc: { type: 'string', default: 'Stručna restauracija crteža, grafika i vintage plakata različitih tehnika' },
            ctaTitle: { type: 'string', default: 'Vaše umetnička dela zaslužuju najbolju negu' },
            ctaDesc: { type: 'string', default: 'Kontaktirajte nas za besplatnu procenu i savet o najboljem pristupu konzervaciji vašeg umetničkog blaga' },
            ctaPrimaryLabel: { type: 'string', default: 'Zakažite Konsultaciju' },
            ctaPrimaryAnchor: { type: 'string', default: '#contact' },
            ctaSecondaryLabel: { type: 'string', default: 'Pošaljite Upit' },
            ctaSecondaryHref: { type: 'string', default: 'mailto:info@lunart.rs' },
            ctaInfoText: { type: 'string', default: 'Beograd, Srbija • Besplatna procena • 20+ godina iskustva' }
        },
        'lunart/services': {
            heading: { type: 'string', default: 'Naše Usluge' },
            description: { type: 'string', default: 'Pružamo kompletne usluge konzervacije i restauracije sa više od 15 godina iskustva u radu sa umetničkim delima na papiru' },
            limit: { type: 'number', default: 6 },
            ctaTitle: { type: 'string', default: 'Potrebna vam je procena?' },
            ctaDesc: { type: 'string', default: 'Kontaktirajte nas za besplatnu konsultaciju i procenu stanja vašeg umetničkog dela' },
            ctaBtnLabel: { type: 'string', default: 'Zakažite konsultaciju' },
            ctaBtnAnchor: { type: 'string', default: '#contact' }
        },
        'lunart/gallery': {
            heading: { type: 'string', default: 'Galerija Radova' },
            description: { type: 'string', default: 'Pogledajte transformacije koje smo ostvarili kroz godine rada - svaki projekat je jedinstvena priča o obnovi umetnosti' },
            limit: { type: 'number', default: 12 },
            ctaTitle: { type: 'string', default: 'Želite da vidite više?' },
            ctaDesc: { type: 'string', default: 'Posetite našu kompletnu galeriju sa preko 200 uspešno restauriranih radova' },
            ctaBtnLabel: { type: 'string', default: 'Kompletna Galerija' },
            ctaBtnAnchor: { type: 'string', default: '#gallery' }
        },
        'lunart/blog-teaser': {
            heading: { type: 'string', default: 'Blog o Konzervaciji' },
            description: { type: 'string', default: 'Saznajte više o tehnikama konzervacije, istoriji umetnosti i našim najnovijim projektima restauracije.' },
            ctaTitle: { type: 'string', default: 'Želite da saznate više?' },
            ctaDesc: { type: 'string', default: 'Pratite naš blog za najnovije informacije o konzervaciji i restauraciji' },
            ctaBtnLabel: { type: 'string', default: 'Pratite Blog' },
            ctaBtnAnchor: { type: 'string', default: '#blog' }
        },
        'lunart/about': {
            heading: { type: 'string', default: 'O Lunart-u' },
            paragraph: { type: 'string', default: 'Lunart je specijalizovana ustanova posvećena očuvanju kulturnog nasleđa kroz stručnu konzervaciju i restauraciju umetničkih dela na papiru. Sa više od 15 godina iskustva, naš tim stručnjaka koristi najsavremenije tehnike i materijale za vraćanje originalnog sjaja vašim dragocenim umetničkim delima.' },
            quoteText: { type: 'string', default: '"Svaki rad koji prođe kroz naše ruke nije samo restauriran - on je vraćen u život, spreman da inspiriše buduće generacije."' },
            quoteAuthor: { type: 'string', default: '- Tim Lunart' },
            ctaTitle: { type: 'string', default: 'Želite da saznate više o nama?' },
            ctaDesc: { type: 'string', default: 'Kontaktirajte nas za besplatnu konsultaciju i saznajte kako možemo pomoći vašem umetničkom delu' },
            ctaBtnLabel: { type: 'string', default: 'Kontaktirajte Nas' },
            ctaBtnAnchor: { type: 'string', default: '#contact' }
        },
        'lunart/cta': {
            title: { type: 'string', default: 'Želite da saznate više?' },
            description: { type: 'string', default: 'Kontaktirajte nas za besplatnu konsultaciju.' },
            buttonLabel: { type: 'string', default: 'Kontaktirajte Nas' },
            buttonHref: { type: 'string', default: '#contact' },
            styleVariant: { type: 'string', default: 'primary' }
        }
    };

    var blocks = [
        { name: 'lunart/hero', title: __('Hero', 'lunart'), icon: 'slides' },
        { name: 'lunart/services', title: __('Usluge', 'lunart'), icon: 'index-card' },
        { name: 'lunart/gallery', title: __('Galerija', 'lunart'), icon: 'format-gallery' },
        { name: 'lunart/blog-teaser', title: __('Blog Teaser', 'lunart'), icon: 'admin-post' },
        { name: 'lunart/about', title: __('O Lunart-u', 'lunart'), icon: 'admin-users' },
        { name: 'lunart/cta', title: __('CTA', 'lunart'), icon: 'megaphone' }
    ];

    blocks.forEach(function(info){
        if (!wp.blocks.getBlockType(info.name)) {
            wp.blocks.registerBlockType(info.name, {
                title: info.title,
                icon: info.icon,
                category: 'lunart',
                attributes: ATTR[info.name] || {},
                supports: { anchor: true },
                edit: serverRenderedPlaceholder(info.title),
                save: function(){ return null; }
            });
        }
    });
})(window.wp);
