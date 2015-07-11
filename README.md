# Google Ad Console

[![Build Status](https://travis-ci.org/stevegrunwell/google-ad-console.png)](https://travis-ci.org/stevegrunwell/google-ad-console)

This plugin adds a simple "Google Ads Console" link to the WordPress admin bar, enabling logged-in users to easily toggle the [Google Publisher Console](https://support.google.com/dfp_sb/answer/181070?hl=en) when troubleshooting ad placements using Google Publisher Tags on your site.

*Please note that this plugin is in no way affiliated with Google Inc. or its subsidiaries.*

## Filters

If you'd like to customize the "Google Ad Console" admin bar link before it's generated, you can use the `googleadconsole_before_add_node` filter to adjust the arguments ultimately passed to `$wp_admin_bar->add_node()`.

### Example

If you wanted to change the label to simply "Google Ads", you could use the following approach:

```php
/**
 * Change the "Google Ad Console" label to "Google Ads".
 *
 * @param array $args WP admin bar node arguments.
 * @return array The filtered arguments.
 */
function mytheme_ads_console_label( $args ) {
	$args['title'] = esc_html__( 'Google Ads', 'my-theme' );

	return $args;
}
add_filter( 'googleadconsole_before_add_node', 'mytheme_ads_console_label' );
```

## License

The MIT License (MIT)

Copyright (c) 2015 Steve Grunwell

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.