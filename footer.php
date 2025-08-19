    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <a href="<?php echo home_url('/'); ?>">
                            <?php echo lunart_get_logo_html(); ?>
                        </a>
                    </div>
                    <h3 class="gradient-text">LUNART</h3>
                    <p>Vaš pouzdani partner za konzervaciju i restauraciju umetničkih dela</p>
                </div>
                
                <div class="footer-section">
                    <h4>Poslovni podaci</h4>
                    <div class="business-info">
                        <p><strong>Naziv:</strong> <?php echo get_theme_mod('lunart_footer_company_name', 'LUNART'); ?></p>
                        <p><strong>Poslovno ime:</strong> <?php echo get_theme_mod('lunart_footer_business_name', 'Mila Borak preduzetnik Umetničko stvaralaštvo Lunart Beograd-Zvezdara'); ?></p>
                        <p><strong>Status:</strong> <?php echo get_theme_mod('lunart_footer_status', 'Aktivan'); ?></p>
                        <p><strong>Pravna forma:</strong> <?php echo get_theme_mod('lunart_footer_legal_form', 'Preduzetnik'); ?></p>
                        <p><strong>Matični broj:</strong> <?php echo get_theme_mod('lunart_footer_registration_number', '68039665'); ?></p>
                        <p><strong>Datum osnivanja:</strong> <?php echo get_theme_mod('lunart_footer_establishment_date', '20.05.2025.'); ?></p>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Delatnost</h4>
                    <div class="activity-info">
                        <p><strong>Šifra delatnosti:</strong> <?php echo get_theme_mod('lunart_footer_activity_code', '9003'); ?></p>
                        <p><strong>Opis delatnosti:</strong> <?php echo get_theme_mod('lunart_footer_activity_description', 'Umetničko stvaralaštvo'); ?></p>
                        <p><strong>PIB:</strong> <?php echo get_theme_mod('lunart_footer_tax_id', '115033613'); ?></p>
                        <p><strong>Broj tekućeg računa:</strong> <?php echo get_theme_mod('lunart_footer_bank_account', '265-1630310011591-68'); ?></p>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Kontakt</h4>
                    <div class="contact-info">
                        <p><?php echo get_theme_mod('contact_address', 'Beograd-Zvezdara'); ?></p>
                        <p>Email: <?php echo get_theme_mod('contact_email', 'info@lunart.rs'); ?></p>
                        <p>Tel: <?php echo get_theme_mod('contact_phone', '+381 XX XXX XXXX'); ?></p>
                    </div>
                </div>

                <?php if (get_theme_mod('footer_show_social', true)) : ?>
                    <div class="footer-section">
                        <?php echo lunart_get_social_media_html(); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p><?php echo get_theme_mod('footer_copyright', '&copy; ' . date('Y') . ' LUNART. Sva prava zadržana.'); ?></p>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

