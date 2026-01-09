# Support Snapshot

A WordPress plugin that generates clean, readable support reports for troubleshooting.

**Author:** Shafinoid  
**Version:** 1.0.0  
**Requires at least:** WordPress 5.0  
**Requires PHP:** 7.0  
**License:** GPL v2 or later

---

## What This Plugin Does

When you ask for help with a WordPress issue, support teams often need to know basic details about your environment:

- What version of WordPress are you running?
- What PHP version is your server using?
- Which theme and plugins are active?
- Are there any memory or debug settings that might be relevant?

Instead of manually gathering this information from multiple places, **Support Snapshot** collects it all in one place and formats it in a way that's easy to read and share.

---

## Why Support Teams Need This

Support teams can't see your server. They can't log into your site. When troubleshooting, they're working blind unless you provide environment details.

Common issues that require environment info:
- **Plugin conflicts** – knowing which plugins are active helps identify conflicts
- **PHP compatibility** – some features require specific PHP versions
- **Memory issues** – low memory limits cause crashes and errors
- **Theme problems** – child themes and parent theme versions matter
- **Debug mode** – whether debug mode is on affects error visibility

This plugin makes it trivial to share accurate information, which speeds up troubleshooting significantly.

---

## How to Use

1. **Install and activate** the plugin
2. Go to **Tools → Support Snapshot** in your WordPress admin
3. Review the information displayed
4. Click **"Copy to Clipboard"**
5. Paste the report into your support ticket or forum post

That's it. No configuration needed.

---

## What Information Is Collected

### WordPress
- Version, site URL, multisite status, language, timezone, permalink structure, HTTPS status, database version

### Server Environment
- PHP version, server software, memory limits, execution time limits, upload limits

### Active Theme
- Theme name, version, author, parent theme (if child theme)

### Active Plugins
- All active plugins with their versions and authors

### Debug Settings
- Status of `WP_DEBUG`, `WP_DEBUG_LOG`, `WP_DEBUG_DISPLAY`, `SCRIPT_DEBUG`, `SAVEQUERIES`

---

## What This Plugin Does NOT Do

- **Does not store data** – Information is generated on-demand when you view the page
- **Does not send data externally** – Nothing leaves your server
- **Does not expose passwords or keys** – No sensitive credentials are included
- **Does not run on the frontend** – Admin-only functionality
- **Does not track you** – No analytics, no phone-home behavior

---

## Security

- **Capability checks** – Only administrators can access the plugin
- **Escaped output** – All data is properly escaped to prevent XSS
- **No database writes** – Plugin doesn't store anything in the database
- **No external requests** – Plugin doesn't communicate with external services

---

## Future Improvements

Possible enhancements that could be added:

- **Export as file** – Download the report as a `.txt` file
- **Selective sections** – Choose which sections to include
- **Custom notes field** – Add context about the issue you're experiencing
- **Server health checks** – Flag common misconfigurations
- **Translation support** – Full internationalization

These are intentionally not included in v1.0 to keep the plugin simple and focused.

---

## Installation

### From WordPress Admin
1. Download the plugin zip file
2. Go to **Plugins → Add New → Upload Plugin**
3. Choose the zip file and click **Install Now**
4. Click **Activate Plugin**

### Manual Installation
1. Upload the `support-snapshot` folder to `/wp-content/plugins/`
2. Activate the plugin through the **Plugins** menu in WordPress

---

## Frequently Asked Questions

### Is this safe to use?
Yes. The plugin only reads information that's already available in your WordPress admin. It doesn't modify anything or send data anywhere.

### Can I share the report publicly?
The report contains your site URL and server details, but no passwords or sensitive keys. Use your judgment based on what you're comfortable sharing.

### Does this work with multisite?
Yes, but it shows information for the current site only.

### Will this slow down my site?
No. The plugin only runs when you visit the admin page. It has zero impact on frontend performance.

---

## Support

For issues or questions, please open an issue on the [GitHub repository](https://github.com/shafinoid/support-snapshot).

---

## Changelog

### 1.0.0
- Initial release
- Core environment data collection
- Clean admin interface
- Copy to clipboard functionality
