/**
 * Lunart Demo Content Importer JavaScript
 */

jQuery(document).ready(function($) {
    'use strict';
    
    var importProgress = 0;
    var importTotal = 0;
    var importResults = {};
    
    // Initialize progress bar
    $('#progressbar').progressbar({
        value: 0,
        max: 100
    });
    
    // Start import button click
    $('#start_import').on('click', function() {
        if (confirm(lunartDemoImporter.strings.confirm)) {
            startImport();
        }
    });
    
    // Reset demo button click
    $('#reset_demo').on('click', function() {
        if (confirm('Are you sure you want to reset all demo content? This action cannot be undone.')) {
            resetDemoContent();
        }
    });
    
    /**
     * Start the import process
     */
    function startImport() {
        // Get import options
        var importOptions = {
            import_posts: $('#import_posts').is(':checked'),
            import_pages: $('#import_pages').is(':checked'),
            import_media: $('#import_media').is(':checked'),
            import_menus: $('#import_menus').is(':checked'),
            import_services: $('#import_services').is(':checked'),
            import_categories: $('#import_categories').is(':checked'),
            import_tags: $('#import_tags').is(':checked'),
            import_widgets: $('#import_widgets').is(':checked'),
            import_customizer: $('#import_customizer').is(':checked'),
            overwrite_existing: $('#overwrite_existing').is(':checked'),
            import_attachments: $('#import_attachments').is(':checked'),
            setup_footer: $('#setup_footer').is(':checked'),
            nonce: lunartDemoImporter.nonce
        };
        
        // Calculate total steps
        importTotal = 0;
        if (importOptions.import_posts) importTotal++;
        if (importOptions.import_pages) importTotal++;
        if (importOptions.import_media) importTotal++;
        if (importOptions.import_menus) importTotal++;
        if (importOptions.import_services) importTotal++;
        if (importOptions.import_categories) importTotal++;
        if (importOptions.import_tags) importTotal++;
        if (importOptions.import_widgets) importTotal++;
        if (importOptions.import_customizer) importTotal++;
        if (importOptions.setup_footer) importTotal++;
        
        // Reset progress
        importProgress = 0;
        importResults = {};
        
        // Show progress section
        $('.import-progress').show();
        $('.import-results').hide();
        
        // Update status
        updateProgressStatus('Starting import...');
        
        // Disable start button
        $('#start_import').prop('disabled', true);
        
        // Start import process
        importContent(importOptions);
    }
    
    /**
     * Import content step by step
     */
    function importContent(options) {
        var importSteps = [];
        
        if (options.import_posts) {
            importSteps.push('posts');
        }
        if (options.import_pages) {
            importSteps.push('pages');
        }
        if (options.import_media) {
            importSteps.push('media');
        }
        if (options.import_menus) {
            importSteps.push('menus');
        }
        if (options.import_services) {
            importSteps.push('services');
        }
        if (options.import_categories) {
            importSteps.push('categories');
        }
        if (options.import_tags) {
            importSteps.push('tags');
        }
        if (options.import_widgets) {
            importSteps.push('widgets');
        }
        if (options.import_customizer) {
            importSteps.push('customizer');
        }
        if (options.setup_footer) {
            importSteps.push('footer');
        }
        
        processImportSteps(importSteps, 0, options);
    }
    
    /**
     * Process import steps sequentially
     */
    function processImportSteps(steps, currentIndex, options) {
        if (currentIndex >= steps.length) {
            // All steps completed
            importComplete();
            return;
        }
        
        var currentStep = steps[currentIndex];
        updateProgressStatus('Importing ' + currentStep + '...');
        
        switch (currentStep) {
            case 'posts':
            case 'pages':
            case 'media':
            case 'menus':
            case 'services':
                importDemoContent(currentStep, options, function() {
                    processImportSteps(steps, currentIndex + 1, options);
                });
                break;
            case 'widgets':
                importDemoWidgets(options, function() {
                    processImportSteps(steps, currentIndex + 1, options);
                });
                break;
            case 'categories':
                importDemoContent('categories', options, function() {
                    processImportSteps(steps, currentIndex + 1, options);
                });
                break;
            case 'tags':
                importDemoContent('tags', options, function() {
                    processImportSteps(steps, currentIndex + 1, options);
                });
                break;
            case 'footer':
                importDemoContent('footer', options, function() {
                    processImportSteps(steps, currentIndex + 1, options);
                });
                break;
            case 'customizer':
                importDemoCustomizer(options, function() {
                    processImportSteps(steps, currentIndex + 1, options);
                });
                break;
        }
    }
    
    /**
     * Import demo content (posts, pages, media, menus)
     */
    function importDemoContent(contentType, options, callback) {
        $.ajax({
            url: lunartDemoImporter.ajaxUrl,
            type: 'POST',
            data: {
                action: 'import_demo_content',
                content_type: contentType,
                import_posts: options.import_posts,
                import_pages: options.import_pages,
                import_media: options.import_media,
                import_menus: options.import_menus,
                import_services: options.import_services,
                import_categories: options.import_categories,
                import_tags: options.import_tags,
                setup_footer: options.setup_footer,
                overwrite_existing: options.overwrite_existing,
                nonce: lunartDemoImporter.nonce
            },
            success: function(response) {
                if (response.success) {
                    importResults[contentType] = response.data;
                    logMessage('Successfully imported ' + contentType, 'success');
                } else {
                    logMessage('Error importing ' + contentType + ': ' + response.data.message, 'error');
                }
                
                // Update progress
                importProgress++;
                updateProgress();
                
                // Continue to next step
                callback();
            },
            error: function(xhr, status, error) {
                logMessage('AJAX error importing ' + contentType + ': ' + error, 'error');
                importProgress++;
                updateProgress();
                callback();
            }
        });
    }
    
    /**
     * Import demo widgets
     */
    function importDemoWidgets(options, callback) {
        $.ajax({
            url: lunartDemoImporter.ajaxUrl,
            type: 'POST',
            data: {
                action: 'import_demo_widgets',
                overwrite_existing: options.overwrite_existing,
                nonce: lunartDemoImporter.nonce
            },
            success: function(response) {
                if (response.success) {
                    importResults.widgets = response.data;
                    logMessage('Successfully imported widgets', 'success');
                } else {
                    logMessage('Error importing widgets: ' + response.data.message, 'error');
                }
                
                importProgress++;
                updateProgress();
                callback();
            },
            error: function(xhr, status, error) {
                logMessage('AJAX error importing widgets: ' + error, 'error');
                importProgress++;
                updateProgress();
                callback();
            }
        });
    }
    
    /**
     * Import demo customizer settings
     */
    function importDemoCustomizer(options, callback) {
        $.ajax({
            url: lunartDemoImporter.ajaxUrl,
            type: 'POST',
            data: {
                action: 'import_demo_customizer',
                overwrite_existing: options.overwrite_existing,
                nonce: lunartDemoImporter.nonce
            },
            success: function(response) {
                if (response.success) {
                    importResults.customizer = response.data;
                    logMessage('Successfully imported customizer settings', 'success');
                } else {
                    logMessage('Error importing customizer settings: ' + response.data.message, 'error');
                }
                
                importProgress++;
                updateProgress();
                callback();
            },
            error: function(xhr, status, error) {
                logMessage('AJAX error importing customizer settings: ' + error, 'error');
                importProgress++;
                updateProgress();
                callback();
            }
        });
    }
    
    /**
     * Update progress bar and percentage
     */
    function updateProgress() {
        var percentage = Math.round((importProgress / importTotal) * 100);
        $('#progressbar').progressbar('value', percentage);
        updateProgressStatus('Progress: ' + importProgress + ' of ' + importTotal + ' steps completed');
    }
    
    /**
     * Update progress status text
     */
    function updateProgressStatus(message) {
        $('#progress-status').text(message);
        logMessage(message, 'info');
    }
    
    /**
     * Log message to import log
     */
    function logMessage(message, type) {
        var timestamp = new Date().toLocaleTimeString();
        var logEntry = $('<div class="log-entry log-' + type + '">[' + timestamp + '] ' + message + '</div>');
        $('#import-log').append(logEntry);
        $('#import-log').scrollTop($('#import-log')[0].scrollHeight);
    }
    
    /**
     * Import complete
     */
    function importComplete() {
        updateProgressStatus('Import completed successfully!');
        logMessage('All import steps completed', 'success');
        
        // Show results
        showImportResults();
        
        // Re-enable start button
        $('#start_import').prop('disabled', false);
    }
    
    /**
     * Show import results summary
     */
    function showImportResults() {
        var summary = '<div class="import-summary">';
        summary += '<h4>Import Summary</h4>';
        summary += '<table class="widefat">';
        summary += '<thead><tr><th>Content Type</th><th>Imported</th><th>Skipped</th></tr></thead>';
        summary += '<tbody>';
        
        for (var contentType in importResults) {
            if (importResults.hasOwnProperty(contentType)) {
                var result = importResults[contentType];
                var imported = result.imported || 0;
                var skipped = result.skipped || 0;
                
                summary += '<tr>';
                summary += '<td>' + contentType.charAt(0).toUpperCase() + contentType.slice(1) + '</td>';
                summary += '<td>' + imported + '</td>';
                summary += '<td>' + skipped + '</td>';
                summary += '</tr>';
            }
        }
        
        summary += '</tbody></table>';
        summary += '<p><strong>Total imported:</strong> ' + importProgress + ' content types</p>';
        summary += '</div>';
        
        $('#import-summary').html(summary);
        $('.import-results').show();
    }
    
    /**
     * Reset demo content
     */
    function resetDemoContent() {
        $.ajax({
            url: lunartDemoImporter.ajaxUrl,
            type: 'POST',
            data: {
                action: 'reset_demo_content',
                nonce: lunartDemoImporter.nonce
            },
            success: function(response) {
                if (response.success) {
                    alert('Demo content reset successfully!');
                    location.reload();
                } else {
                    alert('Error resetting demo content: ' + response.data.message);
                }
            },
            error: function(xhr, status, error) {
                alert('AJAX error: ' + error);
            }
        });
    }

    // Mobile menu toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.mobile-menu').toggleClass('active');
    });

    // Close mobile menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.navigation').length) {
            $('.mobile-menu').removeClass('active');
        }
    });
    
    // Add some visual feedback for checkboxes
    $('.import-section input[type="checkbox"]').on('change', function() {
        var section = $(this).closest('.import-section');
        if ($(this).is(':checked')) {
            section.addClass('selected');
        } else {
            section.removeClass('selected');
        }
    });
    
    // Initialize selected state
    $('.import-section input[type="checkbox"]:checked').each(function() {
        $(this).closest('.import-section').addClass('selected');
    });
});
