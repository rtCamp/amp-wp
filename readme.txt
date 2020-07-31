=== AMP ===
Contributors: google, xwp, automattic, westonruter, albertomedina, schlessera, swissspidy, pierlo, johnwatkins0, joshuawold, ryankienstra
Tags: amp, mobile, optimization, accelerated mobile pages, framework, components, blocks, performance, ux, seo, official
Requires at least: 4.9
Tested up to: 5.5
Stable tag: 1.5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 5.6

The Official AMP plugin, supported by the AMP team. Formerly Accelerated Mobile Pages, AMP enables great experiences across both mobile and desktop.

== Description ==

**The Official AMP Plugin** enables AMP content publishing with WordPress in a way that is fully and seamlessly integrated with the standard mechanisms of the platform. 

The main functional aspects of the AMP Plugin are the following:

1. **Automate as much as possible the process of generating AMP-valid markup**, letting users follow workflows that are as close as possible to the standard workflows on WordPress they are used to
2. **Provide effective validation tools** to help users deal with AMP incompatibilities when they happen, including mechanisms for identifying errors, contextualizing them, and dealing effectively with  them.
3. **Provide support for AMP development** to make it easier for WordPress developers to build AMP compatible ecosystem components and build websites and solutions with AMP-compatibility built in
4. **Support serving AMP pages on Origin** to make it easier for site owners to take advantage of mobile redirection, AMP-2-AMP linking, no serving of invalid AMP pages, and generation of optimized AMP (e.g. AMP optimizer) by default
5. **Provide an AMP turnkey solution** for segments of WordPress creators to be able to go from zero to publishing AMP pages in no time, regardless of technical expertise or availability of resources.

The official AMP plugin for WordPress is a powerful tool that helps you build user-first WordPress sites, that is, sites that are fast, beautiful, secure, engaging, and accessible.  A user-first site will deliver experiences that delight your users and therefore will increase user engagement and the success of your site. And, contrary to the popular belief of being only for mobile sites, AMP is a fully responsive web component framework, which means that you can provide AMP experiences for your users on both mobile and desktop platforms.


## AMP Plugin Audience: Everyone

This plugin can be used by both developers, as non-developer users:

* If you are a developer or tech savvy user, you can take advantage of advanced developer tools provided by the AMP plugin to fix any validation issues your site may have and reach full AMP compatibility.
* If you are not a developer or tech savvy user, or you just simply don’t want to deal with validation issues and tackling development tasks, the AMP plugin allows you to assemble fully AMP compatible sites with different configurations taking advantage of AMP compatible components, and helping you to cope with validation issues by removing offending markup in cases where it is possible, or suppressing all together the execution of any AMP incompatible plugin in the context of AMP pages.

The bottom line is that regardless of your technical expertise, the Official AMP Plugin can be useful to you. 


## AMP Experiences

The official AMP Plugin enables users (e.g. content creators using the AMP plugin on their WordPress sites) to provide AMP experiences to their users in different ways, which are referred to as Template modes: Standard, Transitional, Reader. The differences between them are in terms of the number of templates used (i.e. one or two), and the number of versions of the site (non-AMP, AMP). Each template mode brings its own value proposition and serves the needs of different scenarios in the large and diverse WordPress ecosystem. And in all cases, the AMP plugin provides as much support as possible in terms of automating the generation of AMP content, as well as keeping the option chosen AMP valid. In a nutshell, the available template modes are the following:

1. **Standard Mode**:  This template mode is the ideal, as there is only one template option for serving requests, and a single AMP version of your site, which besides enabling all your site to be AMP-first, has the added benefit of reducing development and maintenance costs. This mode is a good and easy choice for sites where all components used in the site (themes and plugins) are fully AMP compatible, or some components added to the site may be AMP incompatible but we have the resources or the know-how to fix them. 
2. **Transitional Model**: In this mode there is also a single template option, but there are two versions of the content (AMP, non-AMP). The active template is used for serving  the AMP and non-AMP versions of a given URL. This mode is a good choice if the site uses a theme that is not fully AMP compatible, but the functional differences between the AMP and non-AMP are acceptable. In this case users accessing the site from mobile devices can get the AMP version and get an optimized experience.
3. **Reader Mode**: In this mode there are two different templates, one for AMP and another for non-AMP content, and therefore there are also two versions of the site. This mode may be selected when the site is using a non-AMP compatible theme, but the level of incompatibilities is significant, or you are not technically savvy (or simply does not want to deal with the incompatibilities)  and therefore wants simplified and robust workflows that allow them to take advantage of AMP cost effectively

Different modes would be recommended in different scenarios, depending on the specifics of your site and your role. As you configure the plugin, it will suggest the mode that might be best for you based on its assessment of the theme and plugin used in your site. And, independently of the mode used, you have the option of serve all, or only a portion of your site as AMP. This gives you all the flexibility you need to get started enabling AMP in  your site progressively.


## AMP Ecosystem

It is possible today to assemble great looking user-first sites powered by the AMP plugin by picking and choosing themes and plugins from a growing ecosystem of AMP compatible components. In this context, the AMP plugin acts as an orchestrator on the overall AMP content generation process, and also as a validator and enforcer making it easier to not only to get to AMP experiences, but to stay in them with confidence.

Many popular theme and plugin developers have taken efforts to support The Official AMP Plugin. If you are using a theme like Astra, Newspack or plugins like Yoast, WP Forms — they will work out of the box!  You can see the growing list of tested themes and plugins [here](https://amp-wp.org/ecosystem/). 


## AMP Development

Although there is a growing ecosystem of AMP compatible WordPress components, still there are some ways to go before 100% AMP compatibility in the ecosystem. If you are a developer, or you have the resources to pursue development projects, you may want, in some cases, develop custom functionality (i.e. as a plugin, or in the theme space) to serve your specific needs. The official AMP plugin can be of great help to you by providing powerful and effective developer tools that shed light into the AMP development process as it is done in WordPress, including mechanisms for detailing the root causes of all validation issues, and the contextual space to understand them properly, and dealing with them during the process of achieving full AMP compatibility. 


## WP-CLI

The Official AMP Plugin includes a WP-CLI command `wp amp validate` which can make it easy to validate large sites as well as reset previously stored validation errors among other things.


== Frequently Asked Questions ==

Please see the [FAQs on amp-wp.org](https://amp-wp.org/documentation/frequently-asked-questions/). Don't see an answer to your question? Please [search the support forum](https://wordpress.org/support/plugin/amp/) to see if someone has asked your question. Otherwise, please [open a new support topic](https://wordpress.org/support/plugin/amp/#new-post).


== Installation ==

1. Upload the folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. If you currently use older versions of the plugin in `Reader` mode, it is strongly encouraged to migrate to `Transitional` or `Standard` mode. Depending on your theme/plugins, some development work may be required.

== Getting Started ==

To learn more about the plugin and start leveraging its capabilities to power your AMP content creation workflow check [the official AMP plugin product site](https://amp-wp.org/).

If you are a developer, we encourage you to [follow along](https://github.com/ampproject/amp-wp) or [contribute](https://github.com/ampproject/amp-wp/blob/develop/contributing.md) to the development of this plugin on GitHub.

We have put up a comprehensive FAQ page and extensive documentation to help you start as smoothly as possible.

But if you need some help, we are right here to support you on this plugin’s forum section, as well as through Github issues. And yep, our thriving AMPExpert ecosystem has indie freelancers to enterprise grade agencies in case you need commercial support!

== Screenshots ==

1. In the website experience, theme support enables you to reuse the active theme's templates and stylesheets; all WordPress features (menus, widgets, comments) are available in AMP.
2. All core themes are supported, and many themes can be served as AMP with minimal changes, Otherwise, behavior is often as if JavaScript is turned off in the browser since scripts are removed.
3. Reader mode templates are still available, but they differ from the active theme.
4. Switch from Reader mode to Transitional or Standard mode in AMP settings screen.
5. Standard mode: Using AMP as the framework for your site, not having to maintain an AMP and non-AMP version. Mobile and desktop users get same experience.
6. Transitional mode: A path to making your site fully AMP-compatible, with tools to assist with debugging validation issues along the way.
7. Make the entire site available in AMP or pick specific post types and templates; you can also opt-out on per-post basis.
8. Plugin checks for AMP validity and will indicate when: no issues are found, new issues need review, or issues block AMP from being served.
9. The editor will surface validation issues during content authoring. The specific blocks with validation errors are indicated.
10. Each Validated URL shows the list of validation errors encountered, giving control over whether invalid markup is removed or kept. Keeping invalid markup disables AMP.
11. Each validation error provides a stack trace to identify which code is responsible for the invalid markup, whether a theme, plugin, embed, content block, and so on.
12. Styles added by themes and plugins are automatically concatenated, minified, and tree-shaken to try to keep the total under 75KB of inline CSS.
13. A WP-CLI command is provided to check the URLs on a site for AMP validity. Results are available in the admin for inspection.

== Changelog ==

For the plugin’s changelog, please see [the Releases page on GitHub](https://github.com/ampproject/amp-wp/releases).