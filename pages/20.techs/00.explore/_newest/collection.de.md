---
title: Neueste
module_link: '/techs/order-by/date/desc'
module_description: 'Kürzlich hinzugefügt'

module_wrapper_classes: 'col-12'
item_wrapper_classes: 'col-6 col-lg-3'

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
