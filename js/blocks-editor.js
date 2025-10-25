(function(wp){
    if (!wp || !wp.blocks) { return; }
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var __ = wp.i18n.__;

    // Resolve ServerSideRender component across WP versions
    var SSR = (wp.serverSideRender)
        || (wp.blockEditor && wp.blockEditor.ServerSideRender)
        || (wp.editor && wp.editor.ServerSideRender);

    var InspectorControls = (wp.blockEditor && wp.blockEditor.InspectorControls) || (wp.editor && wp.editor.InspectorControls);
    var components = wp.components || {};
    var PanelBody = components.PanelBody;
    var TextControl = components.TextControl;
    var TextareaControl = components.TextareaControl;
    var RangeControl = components.RangeControl;
    var SelectControl = components.SelectControl;
    var ToggleControl = components.ToggleControl;
    var __experimentalNumberControl = components.__experimentalNumberControl || components.NumberControl;

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
            postsPerPage: { type: 'number', default: 3 },
            category: { type: 'string', default: '' },
            orderBy: { type: 'string', default: 'date' },
            order: { type: 'string', default: 'DESC' },
            showDate: { type: 'boolean', default: true },
            showExcerpt: { type: 'boolean', default: true },
            excerptLength: { type: 'number', default: 20 },
            showImage: { type: 'boolean', default: true },
            columns: { type: 'number', default: 3 },
            readMoreLabel: { type: 'string', default: 'Pročitaj više' },
            showViewAll: { type: 'boolean', default: true },
            viewAllLabel: { type: 'string', default: 'Pogledaj sve objave' },
            ctaTitle: { type: 'string', default: '' },
            ctaDesc: { type: 'string', default: '' },
            ctaBtnLabel: { type: 'string', default: '' },
            ctaBtnAnchor: { type: 'string', default: '' }
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
        },
        'lunart/footer': {
            showLogo: { type: 'boolean', default: true },
            title: { type: 'string', default: 'LUNART' },
            tagline: { type: 'string', default: 'Vaš pouzdani partner za konzervaciju i restauraciju umetničkih dela' },
            companyName: { type: 'string', default: 'LUNART' },
            businessName: { type: 'string', default: 'Mila Borak preduzetnik Umetničko stvaralaštvo Lunart Beograd-Zvezdara' },
            status: { type: 'string', default: 'Aktivan' },
            legalForm: { type: 'string', default: 'Preduzetnik' },
            registrationNumber: { type: 'string', default: '68039665' },
            establishmentDate: { type: 'string', default: '20.05.2025.' },
            activityCode: { type: 'string', default: '9003' },
            activityDescription: { type: 'string', default: 'Umetničko stvaralaštvo' },
            taxId: { type: 'string', default: '115033613' },
            bankAccount: { type: 'string', default: '265-1630310011591-68' },
            address: { type: 'string', default: 'Beograd-Zvezdara' },
            email: { type: 'string', default: 'info@lunart.rs' },
            phone: { type: 'string', default: '+381 XX XXX XXXX' },
            showSocial: { type: 'boolean', default: true },
            copyright: { type: 'string', default: '\u00a9 {year} LUNART. Sva prava zadr\u017eana.' }
        }
    };

    var blocks = [
        { name: 'lunart/hero', title: __('Hero', 'lunart'), icon: 'slides' },
        { name: 'lunart/services', title: __('Usluge', 'lunart'), icon: 'index-card' },
        { name: 'lunart/gallery', title: __('Galerija', 'lunart'), icon: 'format-gallery' },
        { name: 'lunart/blog-teaser', title: __('Blog Teaser', 'lunart'), icon: 'admin-post' },
        { name: 'lunart/about', title: __('O Lunart-u', 'lunart'), icon: 'admin-users' },
        { name: 'lunart/cta', title: __('CTA', 'lunart'), icon: 'megaphone' },
        { name: 'lunart/footer', title: __('Footer', 'lunart'), icon: 'admin-site-alt3' }
    ];

    function labelFromKey(key){
        return key
            .replace(/([A-Z])/g, ' $1')
            .replace(/^./, function(s){ return s.toUpperCase(); })
            .replace(/Btn/g, ' Button')
            .replace(/Cta/g, 'CTA');
    }

    function controlForAttr(key, schema, props){
        var val = props.attributes[key];
        var set = function(newVal){
            var v = newVal;
            // Number control can send string; normalize
            if (schema && schema.type === 'number') {
                v = (newVal === '' || newVal === null || typeof newVal === 'undefined') ? undefined : Number(newVal);
            }
            props.setAttributes(((o)=>{ o[key]=v; return o; })({}));
        };
        var label = labelFromKey(key);
        if (schema && schema.type === 'number') {
            if (RangeControl && (key.toLowerCase().indexOf('limit') !== -1)) {
                return el(RangeControl, { label: label, value: typeof val==='number'?val: (schema.default||0), onChange: set, min: 1, max: 24 });
            }
            if (__experimentalNumberControl) {
                return el(__experimentalNumberControl, { label: label, value: val, onChange: set, min: 0 });
            }
            return el(TextControl, { label: label, type: 'number', value: val, onChange: set });
        }
        if (schema && schema.type === 'boolean' && ToggleControl) {
            return el(ToggleControl, { label: label, checked: !!val, onChange: function(checked){ set(!!checked); } });
        }
        // Longer text areas by heuristic
        if (/desc|paragraph/i.test(key)) {
            return el(TextareaControl, { label: label, value: val, onChange: set, rows: 3 });
        }
        // Href/Anchor fields
        if (/href|anchor/i.test(key)) {
            return el(TextControl, { label: label, value: val, onChange: set, placeholder: key.toLowerCase().indexOf('href')!==-1 ? 'https://… or mailto:… or #anchor' : '#anchor' });
        }
        // Style variant select for CTA
        if (/stylevariant/i.test(key) && SelectControl) {
            return el(SelectControl, { label: label, value: val || 'primary', options: [
                { label: __('Primary', 'lunart'), value: 'primary' },
                { label: __('Outline', 'lunart'), value: 'outline' }
            ], onChange: set });
        }
        return el(TextControl, { label: label, value: val, onChange: set });
    }

    blocks.forEach(function(info){
        if (!wp.blocks.getBlockType(info.name)) {
            wp.blocks.registerBlockType(info.name, {
                title: info.title,
                icon: info.icon,
                category: 'lunart',
                attributes: ATTR[info.name] || {},
                supports: { anchor: true },
                edit: function(props){
                    var schema = ATTR[info.name] || {};
                    var controls = Object.keys(schema).map(function(k){
                        return el('div', { key: k }, controlForAttr(k, schema[k], props));
                    });
                    var inspector = InspectorControls ? el(InspectorControls, { key: 'controls' },
                        el(PanelBody, { title: __('Sadržaj', 'lunart'), initialOpen: true, className: 'lunart-inspector-controls' }, controls)
                    ) : null;
                    var preview = SSR ? el('div', { className: 'lunart-block-editor-ssr', key: 'preview' }, el(SSR, { block: info.name, attributes: props.attributes }))
                                       : el('div', { className: 'lunart-block-editor-placeholder', key: 'placeholder' }, info.title + ' — ' + __('server rendered', 'lunart'));
                    var blockProps = (wp.blockEditor && wp.blockEditor.useBlockProps) ? wp.blockEditor.useBlockProps() : {};
                    return el('div', blockProps, inspector, preview, el('div', { className: 'lunart-editor-hint', style: { fontSize: '12px', color: '#555', marginTop: '8px' } }, __('Sav sadržaj menjate u desnom panelu (ikona zupčanika) u tabu Block.', 'lunart')));
                },
                save: function(){ return null; }
            });
        }
    });
})(window.wp);
