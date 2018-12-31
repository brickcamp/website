---
title: 'Largest'
image: 'image.png'

content:
    items: 
        - '@page.children': '/techs/all'
    order:
        by: header.volume
        dir: desc
    filter:
        published: true
        type: 'tech'
    limit: 12
---