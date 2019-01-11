---
title: 'Oldest'
icon: 'icon.png'
redirect: '/techs/all/orderby:date/orderdir:asc'

content:
    items: 
        - '@page.children': '/techs/all'
    order:
        by: date
        dir: asc
    filter:
        published: true
        type: 'tech'
    limit: 4
---