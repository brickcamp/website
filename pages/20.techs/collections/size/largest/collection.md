---
title: 'Largest'
icon: 'icon.png'

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
    pagination: false
---