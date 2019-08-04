---
title: Newest
title_hidden: true
module_link: '/en/techs/orderby:date/orderdir:desc'
module_description: 'Recently added techniques'

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
