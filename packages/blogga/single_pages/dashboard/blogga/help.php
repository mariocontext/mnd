<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<h1><span>Blogga Help</span></h1>
<div class="ccm-dashboard-inner help">
    <h2>Blogga Overview</h2>
    <div class="cGrey">
        <h3>Thanks for using the Blogga Add-on!</h3>
        <p>The goal of Blogga is to provide a super simple
        way of managing a blog within Concrete5 - while still taking advantage of Concrete5's
        fantastic inline-editing and uber intuitive visual editing capability.</p>

        <h3>Blogga concept and how it fits w/ Concrete5</h3>
        <p>Out of the box, <strong>Concrete5 already does everything (and <em>much</em> more) necessary 
                to manage a blog.</strong>
            Its just not <em>organized or presented</em> in a blog-like fashion. With Blogga, no
            crazy new functionality is being introduced. All Blogga does is help you organize and
            manage your site in a blog-like fashion.</p>
        <p>As FRZ, the CEO of Concrete5 once alluded to, for some reason many people think of a "Blog"
            and "Website" as different things. They're not. A blog is a website. A simple website.
            Each blog post is a page, and usually the blog homepage is just a long list of shortened
            posts. With Concrete5's easy and powerful click-here-to-edit capability, the only thing
            missing from formatting your website like a blog is the ability to <strong>list, tag, and
            categorize "posts" (pages)</strong>.</p>
        <p>Blogga fills this gap.</p>
    </div>

    <h2>The Big Three</h2>
    <div class="cGrey">
        <h3>The Blogga Package Has Three Main Components</h3>
        <p>Its easiest to think of your blog as being made up of three main parts.</p>
        <p>
            <strong>1)</strong> The Blogga Dashboard area<br /><?php  echo $html->image($imgs.'component1.jpg'); ?>
            <br /><br />
            <strong>2, 3)</strong> The Blogga page blocks<br /><?php  echo $html->image($imgs.'components2_3.jpg'); ?>
        </p>
        <p><strong>Important concept:</strong> what is the Blog Posts block?. Easy! All it does is list the posts in a certain blog. Its like a homepage in Wordpress, where all your posts are listed chronologically.</p>
        <p><?php  echo $html->image($imgs.'posts_block.jpg',600); ?></p>
    </div>

    <h2>Getting Started</h2>
    <div class="cGrey">
        <h3>Create your first blog</h3>
        <p>1) In the Blogga dashboard area, <span class="under">start by clicking "Create a blog first!"</span></p>
        <p><?php  echo $html->image($imgs.'scrn1.jpg'); ?></p>

        <p>2) Choose <span class="under">Create a New Page</span>&nbsp;&nbsp;(<strong>IMPORTANT:</strong>There are two ways to create new blogs. 99% of the time you'll use Create New. We'll cover the Choose Existing option later)</p>
        <p><?php  echo $html->image($imgs.'scrn2.jpg'); ?></p>

        <p>3) Fill out your blog info. The only <em>required</em> field is a name, description is optional. If you want your blog homepage to go somewhere other than under your homepage, you can choose to do so (helps if you're managing multiple blogs).</p>
        <p><span class="under">When done, click Create Blog</span></p>
        <p><?php  echo $html->image($imgs.'scrn3.jpg'); ?></p>

        <p>4) You'll be taken back to the 'Add Posts' screen. This is where you'll always go to add new blog posts.<br /><br /> <span class="under">From the dropdown menu, choose your new blog.</span></p>
        <p><?php  echo $html->image($imgs.'scrn4.jpg'); ?></p>

        <p>5) With your blog selected, now give your post a fancy new name. Maybe 'My Kickass Blogga... blog... post'. Or something. The rest of the fields are optional.</p>
        <ul style="margin-left:30px;">
            <li><strong>Post Description:</strong> This field is optional, but encouraged. If you leave this field blank, the POSTS BLOCK on the blog homepage will automatically use the first 250 characters from your post as the description.</li>
            <li><strong>Categories:</strong> All your posts can be categorized. (Since you don't have any yet, none show up. We'll cover how to setup shortly.)</li>
            <li><strong>Tags:</strong> You can tag any post with multiple tags.</li>
            <li><strong>Post Preview Image:</strong> If you want a thumbnail to appear in the posts' summary. Automatically resized.</li>
        </ul>
        <p><?php  echo $html->image($imgs.'scrn5.jpg'); ?></p>

        <p>6) After hitting Create Post, you'll be taken to your new blog post page. Here you can edit the page just as you do any other page in Concrete5.</p>
        <p><?php  echo $html->image($imgs.'scrn6.jpg'); ?></p>

        <h3>Waaaala, you've created a blog and your first post. You rock.</h3>
        <p style="padding-left:0;">Now read on to learn about <strong>tagging</strong> and <strong>categories</strong>.</p>
    </div>

    <h2>Blogga Categories</h2>
    <div class="cGrey">
        <h3>Creating categories for your blog</h3>
        <p>What kind of mess would you have if you couldn't categorize your posts? It'd be terrible. Lets fix that.</p>
        <p>1) <span class="under">Head back to the Blogga dashboard area, and hit the "Manage Blogs" tab.</span> You should see your new new blog details listed in its own area, similar to below.</p>
        <p><?php  echo $html->image($imgs.'scrn7.jpg'); ?></p>

        <p>2) To add your first category, type "My first category" in the box where it says <em>Category Name</em>. <span class="under">Hit Add</span>. Your new category should pop up in the 'Manage Blog Categories' area, like below.</p>
        <p><?php  echo $html->image($imgs.'scrn8.jpg'); ?></p>

        <p>3) Now add a few more, so that it looks like below.</p>
        <p><?php  echo $html->image($imgs.'scrn9.jpg'); ?></p>

        <p>4) Now go back to the Add Posts tab. Select your blog from the dropdown menu, and you should see your newly added categories pop up! Why aren't they always visible? Because Blogga lets you manage multiple blogs, each blog has its own list of categories.</p>
        <p><?php  echo $html->image($imgs.'scrn11.jpg'); ?></p>

        <p>5) Lets say you want to EDIT, or REMOVE an existing category.</p>
        <ul style="margin-left:30px;">
            <li>Head back to the Manage Blogs tab</li>
            <li>To DELETE a category, just click the X icon in the category's box.</li>
            <li>To EDIT an existing category, click directly on the text.<br /><?php  echo $html->image($imgs.'scrn10.jpg'); ?><br /> It will turn into a text field automatically. Make your changes, then click outside the box.<br />Changes are saved automatically.</li>
        </ul>
    </div>

    <h2>Blogga Tags</h2>
    <div class="cGrey">
        <h3>Tag Your Posts Like Its Going Out Of Style</h3>
        <p>Blogga makes tagging your posts a piece of cake.</p>
        <p>1) Head to the Add Posts tab. In the Tags text box, start typing something... like "My first tag". Now hit <span class="under">Make New Tag</span>. You've just <em>created</em> and added your first tag.</p>
        <p><?php  echo $html->image($imgs.'scrn12.jpg'); ?></p>

        <p>2) Now click in the text box again. Start typing in the word "tag". Since there is already a tag in the system matching what you're typing, Blogga will automatically recommend it to you! If you want to use the existing tag, just click on it. Otherwise, if the tag didn't match what you wanted, just create another new one.</p>
        <p><?php  echo $html->image($imgs.'scrn13.jpg'); ?></p>
    </div>

    <h2>Managing Your Blog</h2>
    <div class="cGrey">
        <h3>Editing Posts</h3>
        <p>From the dashboard, head to the Sitemap. All your posts are just <strong>pages</strong> under your blog. Edit them like you would anything else.</p>
        <p><?php  echo $html->image($imgs.'scrn14.jpg'); ?></p>

        <h3>Control your blog homepage</h3>
        <p>Your blog homepage <strong>has the BLOG POSTS block</strong> installed on it. It should look something like below, where your posts are all displayed.</p>
        <p><?php  echo $html->image($imgs.'scrn15.jpg',700); ?></p>

        <p>To change the appearance, put the page in Edit mode, and click EDIT on the BLOG POSTS block.</p>
        <p><?php  echo $html->image($imgs.'scrn16.jpg',700); ?></p>

        <p>When the Edit window appears, you can change how you want the posts to be displayed with all the options below. Experiment to see the different options!</p>
        <p><?php  echo $html->image($imgs.'scrn17.jpg'); ?></p>
    </div>

</div>