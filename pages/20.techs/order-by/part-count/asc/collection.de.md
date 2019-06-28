---
title: 'Wenigste Teile'
icon: 'icon.png'

content:
    items: 
        - '@page.children': '/tech'
    order:
        by: header.taxonomy.partcount
        dir: asc
    filter:
        published: true
        type: 'tech'
    limit: 12
---