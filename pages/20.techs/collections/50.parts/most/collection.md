---
title: 'Most Parts'
icon: 'icon.png'

content:
    items: 
        - '@page.children': '/techs/all'
    order:
        by: header.taxonomy.partcount
        dir: desc
    filter:
        published: true
        type: 'tech'
    limit: 12
---