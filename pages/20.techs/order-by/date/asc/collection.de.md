---
title: 'Älteste'
icon: 'icon.png'
link: '/techs/orderby:date/orderdir:asc'
sitemap:
    ignore: true

content:
    items: 
        - '@page.children': '/tech'
    order:
        by: date
        dir: asc
    filter:
        published: true
        type: 'tech'
    limit: 4
---