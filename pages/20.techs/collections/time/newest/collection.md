---
title: 'Newest'
image: 'image.png'
redirect: '/techs/all/orderby:date/orderdir:desc'

content:
    items: 
        - '@page.children': '/techs/all'
    order:
        by: date
        dir: desc
    filter:
        published: true
        type: 'tech'
    limit: 4
---