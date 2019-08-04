---
title: 'Newest'
icon: 'icon.png'
link: '/techs/orderby:date/orderdir:desc'
sitemap:
    ignore: true

content:
    items: 
        - '@page.children': '/tech'
    order:
        by: date
        dir: desc
    filter:
        published: true
        type: 'tech'
    limit: 4
---