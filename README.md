Gridbox Wordpress Theme
===

Gridbox is a static website builder for Wordpress. Gridbox front-end is built on Gridsome and is available [here](https://github.com/idesignzone/gridbox-theme-frontend-free)

Installation
---------------

### Requirements

Gridbox Wordpress Theme requires the following:

- [Wordpress](https://wordpress.org/download/)

### Quick Start

After you have installed Wordpress, search for Gridbox in Wordpress theme directory `appearance -> themes` or download the repository zip file and extract it inside `/wp-content/themes` directory.

1. Go to `appearance -> themes` and activate Gridbox theme
2. Theme will ask you to install optional plugins. (These plugins are required if you intend to use the static front-end). Install and activate WPGraphql - WPGraphQL for ACF and WPGrapgQL Widgets plugins.
3. Fork Gridbox [front-end repository](https://github.com/idesignzone/gridbox-theme-frontend-free) to your github account. 
4. Create a Netlify account and setup to deploy your new repository.
5. In Netlify go to `Build & Deploy -> Environment variables` and add `WORDPRESS_URL` and add your Wordpress backend URL here.
6. Now you can deploy your repository to Netlify. 
7. Finally go to Wordpress admin `Settings -> Site Address (URL)` and change it to your Front-end website URL that you just deployed on Netlify. (You need to deploy you front-end again for this to take place)

### Setup Locally

To setup Gridbox in your local development environment, create a file called `env.development` and add it to the root of your front-end project. In this file define your local or online Wordpress URL like
`WORDPRESS_URL=http://wordpress_url` and run `gridsome develop`. Note that if you have installed wordpress locally under a subfolder like `http://localhost/wordpress` you will get error while compiling the application. Wordpress URL needs to be an absolute domain like `http://my_wordpress.com`


### Deployment Setup

Everytime you edit your content in Wordpress admin, you will need to deploy the front-end for changes to take place. To avoid going to Netlify admin everytime you edit your Wordpress content, go to `appearance -> customize -> Netlify Deployment` and enter your Netlify API ID and Web Hook URL. Now you can find Netlify deployment Widget in the dashboard of Wordpress admin and simply click on Deploy to netlify button everytime you edit content of your website.

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress website. :)

Good luck!
