# Change Log

## 0.2.6 - 10.28.2026
### Fixed
- Every page fataled with "Call to undefined function Amicable\Vite\asset()" when `vendor/` was installed before 0.2.5. The Vite helper is now loaded by the theme instead of Composer's autoloader.
- Custom Footer Text showed in the customizer while the "powered by" credit was on. Customizer controls that don't apply are now hidden when the customizer opens.
- Every page printed the charset and viewport meta tags twice.
- Emoji images were unstyled on browsers without native emoji, because the framework removes the core emoji styles while the emoji script still loads.

### Security
- Updated the build tools: Vite 7.3.7, Rollup 4.66.0 (CVE-2026-27606 was fixed in 4.59) and Immutable 5.1.9 (CVE-2026-29063 was fixed in 5.1.5), with `overrides` keeping Rollup and Immutable at patched versions. `npm audit` finds no vulnerabilities.
- The release workflow stops if `npm audit` finds a high or critical vulnerability.

### Changed
- `backdrop-dev/framework` and `backdrop-dev/fonts` are pinned to the commits this release was tested with, and `composer.lock` is ignored.
- `style.css` requires PHP 7.4, matching `composer.json` (it said 8.0), and WordPress 5.9 or later (ClassicPress 2.0 or later).
- Added a translation template, `public/lang/amicable.pot`, and translator comments for the strings with placeholders.
- The child theme instructions in `readme.md` use `Template: amicable`.

## 0.2.5 - 10.28.2026
### Changed
- Updated to the `develop` branch of `backdrop-dev/framework`, and use the framework's Customize component.
- The release workflow no longer needs the `PRIVATE_KEY` or `TOKEN` secrets; it uses GitHub's built-in token and checks that the release tag matches the `style.css` version.
- Declares `Domain Path: /public/lang` in `style.css`.

### Removed
- Composer dev dependencies (`wptrt/wpthemereview` is abandoned and blocked `composer install`) and `composer.lock`, which pinned the framework's 1.0 branch.

### Fixed
- Submenus can be opened on small and touch screens again, the desktop submenu arrow shows, and the social menu icons are spaced again.
- The menu toggles' screen reader text was empty.
- Pages use the theme's own image sizes instead of loading the full-size featured image.
- Show an admin notice instead of a fatal error when the Backdrop framework isn't installed.
- Removed calls to framework functions that no longer exist (`Backdrop\Theme\is_classicpress`, `Backdrop\Theme\Entry\*`, `Backdrop\Mix\asset`).

## 0.2.4 - 11.19.2025
### Bug
* Fixed Archive styles

## 0.2.3 - 11.17.2025
### Bug
* Fixed Page
* Fixed Primary Navigation

## 0.2.2 - 11.13.2025
### Enhancement
* Moved from Laravel-Mix to Vite for assets
* Update CSS to use BEM

### Bug
* Fixed Permalink for certain titles

## 0.2.1 - 04.09.2025
### Bug
* fixed featured image

## 0.2.0 - 04.03.2025
### Enhancement
* Update Archive

## 0.1.9 - 02.24.2025
### Enhancement
- Restyle Archive

## 0.1.8 - 12.31.2024

### Ehancement
- CSS for Archive pages

## 0.1.7 - 12.30.2024

### Bug
- Fixed current menu color

## 0.1.6 - 12.16.2024
### Enhancement
- Fixed margin for footer credit

## 0.1.5 - 11.18.2024
### Ehancement
- Update Backdrop framework

## 0.1.4 - 11.14.2024
### Enchancement
- Make sure that we support PHP 8.2 or higher

## 0.1.3 - 10.03.2024

### Added
- Added Support for Social Menu

## 0.1.2 - 09.11.2024

### Enhancement
- Make sure that we set html with line-height of 1.15 acrosss browsers

### Added
- Category for single post

## 0.1.1 - 08.21.2024

### Added
- Added a section in Admin Page for Recommended Plugins

## 0.1.0 - 08.19.2024

### Enhancement
- Improved some css styles

### Added
- Custom Pagination for Posts Pagination and Post Navigation

## 0.0.9 - 08.07.2024

### Bug
- Fixed color for entry title

## 0.0.8 - 08.07.2024

### Enhancement
- Make sure tat we support 8.2 and 8.3
- Make sure we set max-width to 100% for post thumbnails

## 0.0.7 - 08.07.2024

### Enhancements
- Update PHP minimum to 7.4
- Reorganize resources files

### Added
- Add Custom template for template-home.php

## 0.0.6 - 08.03.2024

### Added
- Add Theme: Feature Image Support through customizer.

## 0.0.5 - 08.02.2024

### Added
- Add Theme: Custom Footer Credit

## 0.0.4 - 08.01.2024

### Added
- Add Theme: Global Layout
- Add Theme: Settings Options
- Add Custom 404 Error Page

## 0.0.3 - 07.29.2024

### Added
- Add some files for upcoming features

## 0.0.2 - 07.29.2024

### Added
- Add screenshot

## 0.0.1 - 07.29.2024
- Theme launch, Everything's new!
