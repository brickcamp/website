---
title: 'Most Parts'
icon: 'icon.png'

content:
    items: 
        - '@page.children': '/tech'
    order:
        by: header.taxonomy.partcount
        dir: desc
    filter:
        published: true
        type: 'tech'
    limit: 12
---