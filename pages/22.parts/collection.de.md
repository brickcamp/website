---
title: Teile
image: image.jpg  # Photo by Rick Mason on Unsplash (edited)
icon: icon.png

item_wrapper_classes: 'col-4 col-sm-3 col-md-2'
item_show_footer: false

content:
    items:
        - '@page.children': '/part'
    order:
        by: title
    limit: 24
    pagination: true
---