---
title: 'Smallest'
image: 'image.png'

content:
    items: 
        - '@page.children': '/techs/all'
    order:
        by: header.volume
        dir: asc
    filter:
        published: true
        type: 'tech'
    limit: 12
    pagination: false
---