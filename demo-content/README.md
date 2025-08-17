# Lunart Demo Content

This directory contains demo content for the Lunart WordPress theme.

## Structure

```
demo-content/
├── README.md
├── media/           # Demo images and media files
├── screenshots/     # Preview screenshots
└── data/           # Demo content data files (optional)
```

## Media Files

The `media/` directory should contain:
- `welcome-post.jpg` - Featured image for welcome post
- `wordpress-tutorial.jpg` - Featured image for tutorial post
- `homepage-preview.jpg` - Homepage preview screenshot
- `gallery-preview.jpg` - Gallery preview screenshot
- `services-preview.jpg` - Services preview screenshot

## Usage

1. Place your demo images in the `media/` directory
2. Update the image filenames in `functions.php` if needed
3. Users can import demo content via Tools > Demo Content Importer

## Customization

To customize demo content:
1. Edit the data arrays in `functions.php`
2. Add new demo posts, pages, or media
3. Modify widget configurations
4. Update customizer settings

## Notes

- Demo content is imported via AJAX for better user experience
- Users can choose what to import (posts, pages, media, menus, widgets, customizer)
- Overwrite option allows replacing existing content
- All imports are logged for debugging purposes
