(function(wp){
    if (!wp || !wp.blocks) { return; }
    var el = wp.element.createElement;
    var __ = wp.i18n.__;

    // A simple placeholder edit function for server-rendered blocks
    function serverRenderedPlaceholder(title) {
        return function(){
            return el('div', { className: 'lunart-block-editor-placeholder' }, title + ' — ' + __('server rendered', 'lunart'));
        };
    }

    // Register only the lunart/about block (others can be added later)
    wp.blocks.registerBlockType('lunart/about', {
        title: __('O Lunart-u', 'lunart'),
        icon: 'admin-users',
        category: 'widgets',
        attributes: {
            heading: { type: 'string', default: 'O Lunart-u' },
            paragraph: { type: 'string', default: 'Lunart je specijalizovana ustanova posvećena očuvanju kulturnog nasleđa kroz stručnu konzervaciju i restauraciju umetničkih dela na papiru. Sa više od 15 godina iskustva, naš tim stručnjaka koristi najsavremenije tehnike i materijale za vraćanje originalnog sjaja vašim dragocenim umetničkim delima.' },
            quoteText: { type: 'string', default: '"Svaki rad koji prođe kroz naše ruke nije samo restauriran - on je vraćen u život, spreman da inspiriše buduće generacije."' },
            quoteAuthor: { type: 'string', default: '- Tim Lunart' },
            ctaTitle: { type: 'string', default: 'Želite da saznate više o nama?' },
            ctaDesc: { type: 'string', default: 'Kontaktirajte nas za besplatnu konsultaciju i saznajte kako možemo pomoći vašem umetničkom delu' },
            ctaBtnLabel: { type: 'string', default: 'Kontaktirajte Nas' },
            ctaBtnAnchor: { type: 'string', default: '#contact' }
        },
        supports: {
            anchor: true
        },
        edit: serverRenderedPlaceholder(__('O Lunart-u', 'lunart')),
        save: function(){ return null; }
    });
})(window.wp);
