# UberCMS Repository Documentation

## Purpose
UberCMS is a Content Management System (CMS) designed specifically for Habbo Hotel private servers. It's a PHP-based web application that replicates the classic 2010 Habbo Hotel website experience, providing user registration, authentication, community features, and hotel management functionality for retro Habbo servers.

## General Setup

### Technology Stack
- **Backend**: PHP 8.0+ with Apache
- **Database**: MySQL/MariaDB
- **Frontend**: HTML, CSS, JavaScript with classic Habbo Hotel styling
- **Server**: Apache with mod_rewrite enabled
- **Dependencies**: PDO, MySQLi, GD extension, various PHP extensions

### Configuration
- **Main Config**: `nucleo/inc.config.php` - Contains database credentials, site URL, and core settings
- **Database**: Remote MySQL server (177.136.246.76) with 'retro' database
- **Site URL**: Configurable via `$config['Site']['www']` (currently set to http://127.0.0.1:54692)
- **MUS Integration**: Optional Music Server integration for real-time features

### Deployment Options
The README.md describes Docker deployment with:
- PHP 8.0-Apache container
- MariaDB 10.5.8 database
- phpMyAdmin for database management
- Docker Compose orchestration

## Repository Structure

### Core Application (`/`)
- **`index.php`** - Main entry point/homepage
- **`global.php`** - Core initialization, session handling, database connection
- **`client.php`** - Habbo Hotel client launcher
- **`register.php`** - User registration system
- **Various pages** - Community features, help, profiles, etc.

### Core Framework (`/nucleo/`)
- **`class.core.php`** - Core application framework
- **`class.db.mysql.php`** - Database abstraction layer
- **`class.users.php`** - User management and authentication
- **`class.tpl.php`** - Template engine
- **`class.groups.php`** - Group/guild management
- **`inc.config.php`** - Configuration file
- **`/tpl/`** - Template files for all pages
- **`/cron_scripts/`** - Automated maintenance scripts

### Frontend Assets (`/web-gallery/`)
- **`/v2/styles/`** - CSS stylesheets including responsive improvements
- **`/static/js/`** - JavaScript files including responsive enhancements
- **`/images/`** - UI images, icons, backgrounds
- **`/flash/`** - Flash components for registration and badges
- **`/maintenance/`** - Maintenance mode assets

### Content & Media
- **`/c_images/`** - User-generated content images
- **`/images/`** - Static site images and graphics
- **`/habbo-imaging/`** - Avatar and badge generation system
- **`/sounds/`** - Audio files
- **`/gamedata/`** - Game configuration files (furnidata, external variables)

### Management (`/manage/`)
- Administrative interface for site management
- User moderation tools
- Content management system

### Additional Features
- **`/ajax_habblet/`** - AJAX endpoints for dynamic content
- **`/groups/`** - Group/guild system
- **`/myhabbo/`** - User profile customization
- **`/trax/`** - Music player system
- **`/habbowood/`** - Video/movie system

## Recent Enhancements


## CI/CD and Workflows

**Note**: No `.github/` directory or GitHub Actions workflows were found in this repository. The project currently lacks automated CI/CD pipelines.

### Recommended CI/CD Setup:
For future implementation, consider adding:
- **Linting**: PHP CodeSniffer, ESLint for JavaScript
- **Testing**: PHPUnit for backend testing
- **Security**: PHP security scanners
- **Deployment**: Automated deployment scripts
- **Code Quality**: SonarQube or similar tools

## Development Notes

### Version Information
- **CMS Version**: HabboCMS 9.0.0 Build 01
- **Server Version**: 48
- **Creation Date**: 22.08.2010
- **Emulator**: UberEmu (Holograph Emulator)

### Key Dependencies
- PHP 8.0+ with extensions: PDO, MySQLi, GD, intl, xml, curl, soap
- Apache with mod_rewrite
- MySQL/MariaDB database
- Optional: Docker and Docker Compose for containerized deployment

### Security Considerations
- Session-based authentication
- Password hashing (implementation in class.users.php)
- SQL injection protection via PDO
- CSRF protection mechanisms
- Input validation and sanitization

### Performance Features
- Template caching system
- Database connection pooling
- Optimized asset loading
- Responsive design for reduced mobile bandwidth usage

This repository represents a complete Habbo Hotel private server CMS with modern responsive enhancements while maintaining the classic 2010 aesthetic and functionality.
