Intro -

Welcome to General Layout template theme  aka the Zen of Concrete 5 (our tribute to CSS Zen garden) - version 1.0

This is a development tool and not an actual theme. Thus the awful contrasting colors and horrible picture gradients. They're that way so you can easily tell what section is what and if there's some overlap. It's wise to comment out any background colors or images you don't wind up using when you finally launch your site.

I made this because I wanted something I could use to quickly mock up a theme in Concrete 5. I'm not claiming it's perfect and it probably has more than a bit of cruft from past projects; although i tried to get rid of most extraneous code and assets. Please add improvements as you see fit and share them with the community.

I hope this graphic ready template will spur more Concrete 5 theme development from graphics designers who are just looking to just mock up a photoshop or illustrator template.

Guidelines and advice:
http://www.concrete5.org/help/building_with_concrete5/developers/themes/

Although I designed this template for designers who just want to photoshop some images, slice them, load them into the site theme image folder (not the concrete theme folder!) and maybe make a few tweaks to the typography, it can also serve as a useful starting point for those with a deeper background in CSS or PHP. 

This template is free and I ask that designers who find it useful contribute a free theme to the Concrete 5 site for others to use or modify.

Directions-

****I included my Sliced psd file (CS4 but should be backwards compatble to a degree) to make things easier.
****Make sure to Inspect your theme after you installed it and active the additional Layouts (like Category, Org Detail, etc.).

The typography.css is where you can make some basic edits to change the font family, size and overall color of your website's font.

You can also change the background colors or image paths there. Hex colors are used in either long or shorthand format. Don't want to use a background color? Just delete the line! Although we recommend actually commenting it out.

The actual images that you can change are located in the images directory of this theme.
You can add other images but you'll need to add them to the directory and then link them to the appropriate DIV id below. DIV's are recognizable by their pound(#) sign. Classes are prefaced by a dot (.). Section images can be overridden in the internal css of a layout as well.

I've included Wrapper DIVS's to make it easier to tile backgrounds or drop in effects like shadows to go for a full screen header/footer effect or keep it central. You can also float the header, nav, content and footer to the left for a left-aligned effect although the tiling might break down.

Once you're done and you've installed and activated the theme, add a page, enter Edit Mode and choose Design. Choose a page layout (full, left sidebar, etc.) to change the arrangement and what blocks are shown. I recommend creating a fake page and choose 2 column layout first, then switch to a 3 column (see bug list below) and fill in some info. Then change the design and see how it look in various layouts. Note: some info will "disappear" but return depending on the layout. This is in the database, but if a block doesn't appear on a layout it won't be shown. 

Notes on Overall site structure-

-typography.css is the stylesheet where you’ll make most of the style changes.

-reset.css is a scoped reset stylesheet to try to even things out across various browsers.

-main.css contains other css that you may or may not be want to edit. I've put the "easy customizable" CSS here because custom styles must be put here according to Concrete5's theme rules and TinyMCE draws it's styles from here. I recogize this is awkard and you may want to combine pertinent styles back into main.css.

-internal css can be found in each of the page layout's HEAD. This is where we fine tune the column's positions. We've positioned things in main.css and the internal css so that your primary content just below the header in the html. This may help with the Search Engines.

-home.css is for specific home styles. has extra areas you may or may not want to use. Feel free to use another layout for home.

-printFriendly.css strips out all info except for the primaryContent and normalizes fonts. Modify it or not and use if you wish.

-elements Folder - this is where the header, headerItems and Footer includes are kept. (header items allows you to insert things into the header sitewide)

-images Folder - keep to the naming scheme and just swap out if you want.

-thumbnail.png and description.txt - you may want to change according to your specific site.

Layouts:
org_detail - auto generates a breadcrumb and sidenav scoped to the page, which can save some time.
default- should be using the left sidebar layout
view- use the right side bar i believe

Bug list:
-Chrome, Opera and some browsers give a flash of non-image background content and show the background color beforehand.
-The h1 background image in the home layout doesn't show up under IE 6.
-when you create a new page based on the 3 column layout it doesn't add in the header nav. Create a 2 column layout and switch it to to a 3 column.

Resources:

good primer on changing CSS background colors and images:
http://www.w3schools.com/css/css_background.asp

Bug lists, fixes, suggestions and additions are welcome...!
