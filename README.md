# Gatsby WordPress Starter Theme

WordPress starter theme to accompany the Gatsby WordPress Stater project.

## Live demo running on Netlify:

https://thirsty-fermi-fdeecf.netlify.com/

## How to use:

1. Download the zip and install the theme in WordPress.

or

2. Download the WP Migration file and import it into WordPress: https://www.pulsarmedia.ca/files/gatsby/gatsbywpstarter.zip

The theme comes equipped with a portfolio custom post type, two custom REST API scripts to expose several customizer options and sidebar widgets, and a custom video widget. You can use the following GraphiQL query in your Gatsby project to fetch a sidebar with its accompanying widgets by using the following code:

```
{
    widgets: allWordpressWpSidebarsSidebars(
      filter: { parent_sidebar: { eq: "blog-sidebar" } }
    ) {
      edges {
        node {
          id
          name
          rendered
          parent_sidebar
        }
      }
    }
}
```

The "parent_sidebar" parameter will fetch the widgets assigned to your sidebar based on the "id" assigned to that sidebar.

Use the following GraphiQL queries in your Gatsby project to fetch the hero images for the archive, tag and blog templates:

```
{
    archiveHeroImage: wordpressWpApiCustomizerCustomizer(
      name: { eq: "archive_hero_image" }
    ) {
      source_url
    }
}
```

```
{
    tagHeroImage: wordpressWpApiCustomizerCustomizer(
      name: { eq: "tag_hero_image" }
    ) {
      source_url
    }
}
```

```
{
    blogHeroImage: wordpressWpApiCustomizerCustomizer(
      name: { eq: "blog_hero_image" }
    ) {
      source_url
      name
    }
}
```
