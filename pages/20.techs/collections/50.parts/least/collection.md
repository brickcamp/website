---
title: 'Least Parts'
icon: 'icon.png'

content:
    items: 
        - '@page.children': '/techs/all'
    order:
        by: header.taxonomy.partcount
        dir: asc
    filter:
        published: true
        type: 'tech'
    limit: 12
---