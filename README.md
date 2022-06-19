# SOON-BUNDLE

Provide comming soon page to your symfony application

## Configuration

```yaml
soon_bundle:
    logo: media/logo/name.svg # logo url / assets path
    background: media/background/background.jpg  # background url / assets path
    release_date: "2022-07-16 00:00:00" # release date
    exclude_ips: # Ip excluded
        - 192.168.1.0/24
        - 127.0.0.1
    exclude_routes: # route excluded
        - ^/(api|admin)
    socials: # socials links
        twitter:
            icon: fab fa-twitter # Font-awesome 6 icons
            link: https://twitter.com/ # link
        web:
            icon: fa fa-blog
            link: "https://google.fr"
```